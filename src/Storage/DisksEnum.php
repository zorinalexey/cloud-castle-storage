<?php

namespace CloudCastle\Storage;

use CloudCastle\Storage\Disks\DropBox;
use CloudCastle\Storage\Disks\Ftp;
use CloudCastle\Storage\Disks\GoogleDrive;
use CloudCastle\Storage\Disks\Local;
use CloudCastle\Storage\Disks\MailRuDisk;
use CloudCastle\Storage\Disks\Ssh;
use CloudCastle\Storage\Disks\YandexDisk;

enum DisksEnum: string
{
    case FTP = Ftp::class;
    case SFTP = SFtp::class;

    case SSH = Ssh::class;

    case LOCAL = Local::class;

    case GOOGLE_DRIVE = GoogleDrive::class;

    case YANDEX_DISK = YandexDisk::class;

    case DISK_MAIL_RU = MailRuDisk::class;

    case DROP_BOX = DropBox::class;
}
