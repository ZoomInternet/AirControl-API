<?php

namespace AirControl\Api;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Cookie\CookieJar;

class Client
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \GuzzleHttp\Cookie\CookieJar
     */
    private $cookies;

    /**
     * Client constructor.
     *
     * @param                                  $ipAddress
     * @param                                  $login
     * @param                                  $password
     * @param \GuzzleHttp\ClientInterface|null $client
     */
    public function __construct($ipAddress, $login, $password, ClientInterface $client = null)
    {
        $this->cookies = new CookieJar();
        $this->ipAddress = $ipAddress;
        $this->login = $login;
        $this->password = $password;
        $this->client = $client;
        $this->login();
    }

    public function __destruct()
    {
        $this->logout();

        // TODO: Implement __destruct() method.
    }

    public function logout()
    {
        $response = $this->getClient()->request(
            'POST',
            $this->getLogoutUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getClient()
    {
        if (!isset($this->client)) {
            $this->client = new HttpClient(
                [
                    'cookies' => true,
                    'verify' => false,
                ]
            );
        }

        return $this->client;
    }

    /**
     * Add /logout into api url.
     *
     * @return string
     */
    public function getLogoutUrl()
    {
        return $this->getApiUrl().'/logout';
    }

    /**
     * Return api url.
     *
     * @return string
     */
    public function getApiUrl()
    {
        return 'https://'.$this->ipAddress.':9082/api';
    }

    public function login()
    {
        $node = [
            'username' => $this->login,
            'password' => $this->password,
            'eulaAccepted' => true,

        ];

        $response = $this->getClient()->request(
            'POST',
            $this->getLoginUrl(),
            [
                'cookies' => $this->cookies,
                'Content-Type' => 'application/json;charset=UTF-8',
                'json' => $node,
            ]
        );

        return $response->getBody()->getContents();
    }

    /**
     * Add /login into api url.
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->getApiUrl().'/login';
    }

    public function addDevice(string $ipAddress, string $username, string $password, int $ssh_port)
    {
        $node = [
            'name' => 'add_device_manually',
            'args' => [
                'branch_id' => '2',
                'http_port' => 443,
                'ip' => $ipAddress,
                'overridden_server_address' => [
                    'port' => 9081,
                    'ip' => $this->ipAddress,
                ],
                'remember_ssh_settings' => true,
                'sessionId' => time(), // TODO i'm not sure!
                'ssh_password' => $password,
                'ssh_port' => $ssh_port,
                'ssh_username' => $username,
                'type' => 'ubnt',
                'uplink_type' => 'wireless',
                'use_https' => true,
            ],
        ];

        $response = $this->getClient()->post(
            $this->getJobsUrl(),
            [
                'cookies' => $this->cookies,
                'Content-Type' => 'application/json;charset=UTF-8',
                'json' => $node,
            ]
        );

        return $response->getBody()->getContents();
    }

    /**
     * Add /jobs into api url.
     *
     * @return string
     */
    public function getJobsUrl()
    {
        return $this->getApiUrl().'/jobs';
    }

    public function getUsers()
    {
        $response = $this->getClient()->get(
            $this->getUsersUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getUsersUrl()
    {
        return $this->getApiUrl().'/users';
    }

    public function getSessionId()
    {
        $response = $this->getClient()->get(
            $this->getUserSessionUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    /**
     * Add /users/session-user into api url.
     *
     * @return string
     */
    public function getUserSessionUrl()
    {
        return $this->getApiUrl().'/users/session-user';
    }

    public function getUserSession()
    {
        $response = $this->getClient()->get(
            $this->getUserSessionUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getFirmwares()
    {
        $response = $this->getClient()->get(
            $this->getFirmwaresUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getFirmwaresUrl()
    {
        return $this->getApiUrl().'/firmwares';
    }

    public function getLatestFirmwares()
    {
        $response = $this->getClient()->get(
            $this->getLatestFirmwaresUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getLatestFirmwaresUrl()
    {
        return $this->getApiUrl().'/firmwares/latest';
    }

    public function getNetworks()
    {
        $response = $this->getClient()->get(
            $this->getNetworksUrl(),
            [
                'cookies' => $this->cookies,
            ]
        );

        return $response->getBody()->getContents();
    }

    public function getNetworksUrl()
    {
        return $this->getApiUrl().'/networks';
    }

    public function getDevices()
    {
        $response = $this->getClient()->get(
            $this->getDevicesUrl(),
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getDevicesUrl()
    {
        return $this->getApiUrl().'/devices';
    }

    public function getAlerts()
    {
        $response = $this->getClient()->get(
            $this->getAlertsUrl(),
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getAlertsUrl()
    {
        return $this->getApiUrl().'/alerts';
    }

    public function getEula()
    {
        $response = $this->getClient()->get(
            $this->getEulaUrl(),
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getEulaUrl()
    {
        return $this->getApiUrl().'/eula';
    }

    public function getRoles()
    {
        $response = $this->getClient()->get(
            $this->getRolesUrl(),
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getRolesUrl()
    {
        return $this->getApiUrl().'/roles';
    }

    public function getJobs()
    {
        $response = $this->getClient()->get(
            $this->getJobsUrl().'?time=today',
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getChartSets()
    {
        $response = $this->getClient()->get(
            $this->getApiUrl().'/chart-sets/meta',
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getServerUpdate()
    {
        $response = $this->getClient()->get(
            $this->getApiUrl().'/settings/server-update',
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getSettings()
    {
        $response = $this->getClient()->get(
            $this->getApiUrl().'/settings',
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getR()
    {
        $response = $this->getClient()->get(
            $this->getApiUrl().'/r',
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getConfig(int $deviceId)
    {
        $response = $this->getClient()->get(
            $this->getApiUrl()."/devices/{$deviceId}/config",
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getJobDetails($jobId)
    {
        $response = $this->getClient()->get(
            $this->getApiUrl().
            "/jobs/{$jobId}/details",
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }

    public function getDeviceProperties()
    {
        $response = $this->getClient()->get(
            $this->getApiUrl(
            ).'/devices/properties?ids=44,45,46,47,48,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,68,69,70,71,72,73,74,75,76,77,78,79,81,82,83,84,85,88,89,90,91,92,93,94,95,96,99,100,101,102,103,104,105,106,107,108,109,110,111,112,114,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,135,136,137,138,139,140,141,142,143,144,145,146,147,149,150,151,152,153,154,155,156,157,158,159,161,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,209,210,211,212,213,214,215,216,218,219,221,222,223,224,225,226,228,229,230,231,232,233,234,235,236,237,240,241,242,243,244,245,246,247,248,249,250,251,252,253,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283,284,285,286,287,288,289,290,291,292,294,296,297,298,299,300,303,304,305,306,307,308,309,310,311,313,314,315,316,317,318,319,320,321,322,323,324,325,327,328,329,330,331,333,334,335,336,337,338,339,341,342,343,344,345,346,347,348,350,351,352,354,356,357,363,367,368,383,385,386,388,389,390,391,392,393,394,395,396,397,398,399,400,402,403,404,405,407,408,409,410,411,427,428,430,431,433,434,435,436,437,439,440,441,448,449,451,452,453,454,455,457,458,459,460,461,462,463,483,484,485,486,487,488,489,490,491,493,494,495,500,502,503,504,505,506,507,508,514,516,517,518,519,523,524,525,526,527,528,529,530,531,532,533,535,536,537,538,539,540,541,542,543,544,545,546,547,548,551,552,555,556,557,558,560,561,562,563,564,566,571,572,574,575,576,577,578,579,580,581,582,583,586,587,589,590,591,592,593,594,595,596,597,598,599,600,601,602,603,604,605,606,607,608,613,616,617,618,619,620,621,622,623,624,625,626,627,629,630,631,632,633,634,635,636,638,639,640,641,642,645,646,647,648,650,651,652,653,654,656,657,658,659,660,661,663,666,667,668,670,671,672,673,674,676,680,681,682,683,684,685,686,687,688,710,711,712,713,714,715,716,717,718,719,720,723,724,725,726,727,728,729,730,731,732,733,734,735,736,737,767,769,770,771,772,773,774,775,776,777,778,779,780,781,782,807,808,809,810,811,812,813,814,815,816,817,818,828,829,830,831,832,852,853,854,855,856,857,860,865,866,867,868,874,877,883,885,886,887,888,889,890,891,892,893,894,895,896,897,898,899,901,902,905,909,910,911,912,914,915,916,919,920,921,926,927,930,939,940,943,949,950,951,952,953,954,955,959,960,962,963,964,966,972,974,975,976,977,978,979,990,991,992,993,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,1021,1025,1026,1027,1028,1029,1030,1031,1032,1033,1034,1035,1036,1045,1048,1049,1050,1073,1074,1091,1093,1094,1095,1098,1102,1111,1119,1123,1125,1128,1129,1131,1138,1141,1142,1146,1147,1160,1161,1162,1163,1164,1165,1166,1170,1177,1178,1179,1180,1181,1197,1199,1200,1201,1202,1203,1208,1225,1226,1230,1231,1232,1233,1234,1235,1236,1237,1258,1316,1317,1318,1377,1420,1431,1432,1433,1434,1436,1486,1491,1492,1506,1516,1824,1854,1892,1912,1921,1922,1923,1924,2562,3040,3324,3504,3516,3520,3542,3546,3548,3550,3552,3555,3556,3558,3564,3568,3576,3582,3586,3590,3603,3605,3606,3608,3620,3626,3738,43,49,67,80,87,97,98,115,134,148,160,162,208,220,227,238,254,293,295,301,332,340,349,378,401,406,429,432,438,492,509,515,534,567,573,584,585,628,637,644,655,662,665,669,675,721,766,833,884,900,913,961,965,973,1075,1092,1099,1159,1196,1322,1430,1448,3584',
            array(
                'cookies' => $this->cookies,
            )
        );

        return $response->getBody()->getContents();
    }
}
