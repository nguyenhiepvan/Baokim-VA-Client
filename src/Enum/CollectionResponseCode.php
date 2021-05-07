<?php
/**
 * @Created by : PhpStorm
 * @Author : Hiệp Nguyễn
 * @At : 07/05/2021, Friday
 * @Filename : CollectionResponseCode.php
 **/

namespace Nguyenhiep\BaoKimVaClient\Enum;

use MyCLabs\Enum\Enum;

class CollectionResponseCode extends Enum
{
    const SUCCESSFUL                             = 200;
    const TRANSACTION_TIMEOUT                    = 99;
    const FAILED                                 = 11;
    const ERROR_PROCESSING_FROM_BAOKIM           = 101;
    const ERROR_FROM_BANK                        = 102;
    const OPERATION_IS_INCORRECT                 = 103;
    const REQUESTID_OR_REQUEST_IS_INCORRECT      = 104;
    const PARTNERCODE_IS_INCORRECT               = 105;
    const ACCNAME_IS_INCORRECT                   = 106;
    const CLIENTIDNO_IS_INCORRECT                = 107;
    const ISSUEDDATE_OR_ISSUEDPLACE_IS_INCORRECT = 108;
    const COLLECTAMOUNT_IS_INCORRECT             = 109;
    const EXPIREDATE_IS_INCORRECT                = 110;
    const ACCNO_IS_INCORRECT                     = 111;
    const ACCNO_IS_NOT_EXIST                     = 112;
    const REFFERENCEID_IS_INCORRECT              = 113;
    const REFFERENCEID_ISNT_EXISTS               = 114;
    const TRANSAMOUNT_IS_INCORRECT               = 114;
    const TRANSTIME_IS_INCORRECT                 = 116;
    const BEFTRANSDEBT_IS_INCORRECT              = 117;
    const TRANSID_IS_INCORRECT                   = 118;
    const AFFTRANSDEBT_IS_INCORRECT              = 119;
    const SIGNATURE_IS_INCORRECT                 = 120;
    const ACCOUNTTYPE_IS_INCORRECT               = 121;
    const ORDERID_IS_INCORRECT                   = 122;
}