<?php

/* 
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

?>
<!DOCTYPE html>
<html>
    
<head>
    <title>Laporan Hasil Belajar Kelas <?=$id_kelas?></title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 0.8em;
            font-size-adjust: 0.5;
        }
        h1.header-print {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1em;
            font-size-adjust: 0.5;
            text-align: center;
        }
        p.xprint{
            font-size: 0.7em;
            font-weight: bold;
        }
        td.catatan {
            font-family: inherit;
            font-style: italic;
            font-size: 0.8em;
            font-size-adjust: 0.5;
        }
        table {
            vertical-align: text-top;
        }
        table.utama {
            font-family: inherit;
            font-size: 0.75em;
            color:#333333;
            border-width: 1px;
            border-color: #000000;
            border-collapse: collapse;
        }
        table.utama thead {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #dedede;
            text-align: center;
            font-weight: bolder;
        }
        table.utama th {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #dedede;
        }
        table.utama td {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #ffffff;
        }
        td.surat{
            font:inherit;
            font-style: italic;
            text-align: center;
        }
        td.tengah{
            font:inherit;
            text-align: center;
            font-weight: bold;
        }
        div.end-break {
            page-break-after: always;
        }
        div.page-content{
            page-break-inside: avoid;
        }
        li.pernyataan {
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="page-content">
        <h1 class="header-print">SURAT PERNYATAAN</h1>
        <P>Yang bertanda tangan di bawah ini saya:</P>
        <table style="width: 100%; border-style: none">
            <tr>
                <td style="width: 8%; text-align: left">&nbsp;</td>
                <td style="width: 15%; text-align: left">Nama</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 75%; text-align: left"><strong><?=$registrant->getMainParentObj()->getName(); // TODO: Dibuat fleksibel, ayah, ibu, atau wali?></strong></td>
            </tr>
            <tr>
                <td style="width: 8%; text-align: left">&nbsp;</td>
                <td style="width: 15%; text-align: left">Alamat</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 75%; text-align: left"><?=$registrant->getMainParentObj()->getAddress(); // TODO: Dibuat fleksibel, ayah, ibu, atau wali?></td>
            </tr>
            <tr>
                <td style="width: 8%; text-align: left">&nbsp;</td>
                <td style="width: 15%; text-align: left">No. Telp/HP</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 75%; text-align: left"><?=$registrant->getMainParentObj()->getContact(); // TODO: Dibuat fleksibel, ayah, ibu, atau wali?></td>
            </tr>
        </table>
        <p>Orang tua / wali dari calon peserta didik baru 
            SMAIT Ihsanul Fikri Mungkid:</p>
        <table style="width: 100%; border-style: none">
            <tr>
                <td style="width: 8%; text-align: left">&nbsp;</td>
                <td style="width: 15%; text-align: left">Nama</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 75%; text-align: left"><strong><?=$registrant->getName();?></strong></td>
            </tr>
            <tr>
                <td style="width: 8%; text-align: left">&nbsp;</td>
                <td style="width: 15%; text-align: left">No. Pendaftaran</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 75%; text-align: left"><?=$registrant->getId();?></td>
            </tr>
            <tr>
                <td style="width: 8%; text-align: left">&nbsp;</td>
                <td style="width: 15%; text-align: left">I / A</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 75%; text-align: left"><?=($registrant->getSex() == 'L') ? 'Ikhwan' : 'Akhwat'?></td>
            </tr>
        </table>
        <p>Dengan ini menyatakan bahwa:</p>
        <ol>
            <li class="pernyataan">
                Jika anak saya diterima sebagai siswa SMAIT Ihsanul Fikri Mungkid, saya 
                menyerahkan sepenuhnya anak saya dalam hal pembinaan diri selama berstatus siswa SMAIT 
                Ihsanul FIkri Mungkid dan menerima segala konsekuensi akibat peraturan yang berlaku didalamnya.
            </li>
            <li class="pernyataan">
                Jika anak saya diterima sebagai siswa SMAIT Ihsanul Fikri Mungkid, saya akan melunasi Infaq Pendidikan
                sesuai dengan kesanggupan saya sebesar <strong>Rp. <?=$registrant->getInitialCost();?>,-</strong>.
            </li>
            <li class="pernyataan">
                Saya sanggup untuk memenuhi SPP bulanan kepada pihak sekolah sebesar <strong>RP. <?=$registrant->getSubscriptionCost()?>,-</strong>.
            </li>
            <li class="pernyataan">
                Saya sanggup untuk memenuhi Infaq bulanan kepada pihak sekolah sebesar 
                <strong>Rp. <?=$registrant->getMonthlyCharity();?>,-</strong>.
            </li>
            <li class="pernyataan">
                Apabila setelah pendaftaran ulang ternyata anak saya mengundurkan diri, maka saya 
                tidak akan menuntu segala yang telah saya bayarkan sebelumnya.
            </li>
        </ol>
        <p>
            Demikian surat pernyataan ini saya buat denan sebenar-benarnya.
        </p>
        </table>
        <table style="width: 100%; border-style: none">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: center">Mengetahui,</td>
                <td style="width: 34%;">&nbsp;</td>
                <?php
                $date = new DateTime('now');
                ?>
                <td style="width: 33%; text-align: center">Magelang, <?php echo $date->format('j F Y');?></td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: center">Kepala SMAIT Ihsanul Fikri</td>
                <td style="width: 34%; text-align: center">Pewawancara</td>
                <td style="width: 33%; text-align: center">Orang tua / wali murid</td>
            </tr>
            <tr >
                <td style="width: 33%; height: 60px; text-align: center"></td>
                <td style="width: 34%; height: 60px; text-align: center"></td>
                <td style="width: 33%; height: 60px; text-align: center; font-size: 0.65em;
                    font-style: italic;">Materai Rp. 6.000,-</td>
            </tr>
            <tr>
                <td style="width: 33%; text-align: center">...............................</td>
                <td style="width: 34%; text-align: center">...............................</td>
                <td style="width: 33%; text-align: center">...............................</td>
            </tr>
        </table>
    </div>
</body>

</html>