<?php
/**
 * @Created by : PhpStorm
 * @Author : Hiệp Nguyễn
 * @At : 07/05/2021, Friday
 * @Filename : CollectionPayment.php
 **/

namespace Nguyenhiep\BaoKimVaClient\Client;


class CollectionPayment extends Base
{
    public function __construct($private_key, $public_key)
    {
        parent::__construct($private_key, $public_key);
        $this->url_dev  = config("baokim-va-client.url.development");
        $this->url_prod = config("baokim-va-client.url.production");
    }

    /**
     * PARTNER will call transaction by identification status checking,
     * BAOKIM will check the data format and signature authentication
     * If the information is correct, BAOKIM will cancel pending cash transfer transaction and return response to PARTNER.
     *
     * @param string $request_id Unique code , recomment format: PartnerCode + BK + YYYYMMDD + UniqueId.
     * @param string $request_time Time send the request from PARTNER , format: YYYY-MM-DD HH:MM:SS.
     * @param string $partner_code Unique code BAOKIM provide
     * @param int $operation Fix: 9001
     * @param int $create_type Note: BK won't check this field, can send 2
     * @param string $acc_name The name of Account holder (name of USER)
     * @param int $collection_amount_min Require  Min collect amount (Min 50.000 vnd)
     * @param int $collection_amount_max Require  Max collect amount (Max 50.000.000vnd)
     * @param string $order_id Unique id for each VA
     * @param string|null $acc_no VA number (Max 17 characters).Note: BK won't check this field, can send NULL
     * @param string|null $expire_date Expire date. Format: YYYYMM-DD HH:II:SS
     */
    public function register_virtual_account(string $request_id, string $request_time, string $partner_code, int $operation,
                                             int $create_type, string $acc_name, int $collection_amount_min, int $collection_amount_max,
                                             string $order_id, string $acc_no = null, string $expire_date = null
    )
    {
        $data      = [
            "RequestId"        => $request_id,
            "RequestTime"      => $request_time,
            "PartnerCode"      => $partner_code,
            "Operation"        => $operation,
            "CreateType"       => $create_type,
            "AccName"          => $acc_name,
            "CollectAmountMin" => $collection_amount_min,
            "CollectAmountMax" => $collection_amount_max,
            "ExpireDate"       => $expire_date,
            "OrderId"          => $order_id,
            "AccNo"            => $acc_no
        ];
        $signature = $this->makeSignature($data);
        $client    = $this->makeClient($signature);
        $response  = $client->post("", ["json" => $data]);
    }

    /**
     * PARTNER wanto change and save the USER changed informations , will call to “Virtual account information update”.
     * BAOKIM will check about datatype and the signature accuracy .
     * If every submitted datas are correct, BAOKIM will update the virtual account by the provided datas, At the same time BAOKIM will response to PARTNER.
     */
    public function update_virtual_account_informations()
    {

    }

    /**
     * When PARTNER want to get detail information of a virtual account, PARTNER will call to “Virtual account information searching”
     * BAOKIM will check the data type and the signature accuracy, if every submitted data is correct,
     * BAOKIM will get and return all detail infomations of this virtual account , else return error.
     */
    public function virtual_account_information_searching()
    {

    }

    /**
     * When PARTNER want to get all Collection transaction detail information, PARTNER will call to “Collection transaction detail information searching”.
     *
     * BAOKIM will check about datatype and the signature accuracy,
     * If every submitted datas are correct, BAOKIM will reponse exactly detail informations of this collection transaction.
     */
    public function collection_transaction_status_searching()
    {
    }

    /**
     * USER move to collection point then provide VA number (receive from Register virtual account).
     * Collection point send VA numbers to BAOKIM
     * BAOKIM will check then send information to PARTNER
     * PARTNER search information then response to BAOKIM, BAOKIM will response to collection point
     *
     */
    public function collection_at_point()
    {

    }

    /**
     * PARTNER build the system, to receive data notice the collection transaction.
     * When receive a new collection transaction, BAOKIM will call to “collection transaction notification” that provided by PARTNER to notice PARTNER need to update data.
     *
     */
    public function notice_of_collection_transaction()
    {

    }

    /**
     * When Bank A fails to use the support service, BAOKIM will update all VA accounts from other bank B as desired by the partner.
     * Successful update of BAOKIM will send information about this transaction via API to PARTNER.
     * PARTNER will check the information and return the results to BAOKIM
     */
    public function notice_of_account_bank_switching()
    {

    }
}