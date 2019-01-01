<html>
    <head>
        <title></title>
        <style>
            @media print {
                .new-page {
                    page-break-before: always;
                }
            }
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
        <h1>Rekap Dokumen Terupload Siswa</h1>
        <table>
            <table class="data">
            <tr><td colspan="3"><b>Data Siswa</b></td></tr>
            <tr>
                <td> Nomor Pendaftaran </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$reg->getRegId();?> </td>
            </tr>
            <tr>
                <td> Nama </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=  strtoupper($reg->getName());?> </td>
            </tr>
            <tr>
                <td> Sekolah Asal </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?= strtoupper($reg->getPreviousSchool())?> </td>
            </tr>
            <tr>
                <td> Jenis Kelamin </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=($reg->getGender() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
            </tr>
            <tr>
                <td> NISN </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$reg->getNisn()?> </td>
            </tr>
            <tr>
                <td> Email / No. HP </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$reg->getCp()?> </td>
            </tr>
            <tr>
                <td> Program </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$reg->getProgram()?> </td>
            </tr>
        </table>
        <?php 
        $certificates = $reg->getCertificates();
        $count = 1;
        foreach ($certificates as $cert):
        ?>
        <table>
            <tr>
                <td colspan="3"><b>Dokumen ke <?=$count++?></b></td>
            </tr>
            <tr>
                <td> Jalur </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getScheme();?> </td>
            </tr>
            <tr>
                <td> Tipe Dokumen </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getFileType();?> </td>
            </tr>
            <tr>
                <td> Mapel OSN </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getSubject();?> </td>
            </tr>
            <tr>
                <td> Ranking </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=(empty($cert->getRank()))?'-':$cert->getRank();?> </td>
            </tr>
            <tr>
                <td> Tingkat Olimpiade </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getLevel();?> </td>
            </tr>
            <tr>
                <td> Penyelenggara </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getOrganizer();?> </td>
            </tr>
            <tr>
                <td> Lokasi Lomba </td>
                <td> &nbsp;:&nbsp; </td>
                <td> <?=$cert->getPlace();?> </td>
            </tr>
            <tr>
                <td> Tanggal Pelaksanaan </td>
                <td> &nbsp;:&nbsp; </td>
                <td> 
                <?= tgl_indo($cert->getStartDate()->format('Y m d'));?> s/d 
                <?= tgl_indo($cert->getEndDate()->format('Y m d'));?>
                </td>
            </tr>
            
        </table>
            <hr>
            <img src="<?=FCPATH.'data/sertifikat/'.$cert->getFileName().'.png';?>">
            <hr>
            <div class="new-page">
                &nbsp;
            </div>
            <?php endforeach;?>
    </body>
</html>
