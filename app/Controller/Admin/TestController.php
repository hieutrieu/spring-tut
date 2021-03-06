<?php

namespace App\Controller\Admin;

use Framework\Config;
use App\Libraries\PhoneCharge;

class TestController extends AdminController
{
    public function __construct()
    {
        parent::__construct(); // TODO: Change the autogenerated stub
        $this->setTitle('Test');
        $this->config = config('prices');

    }

    public function index()
    {
        $phones = [
            '80808' => 1,
            // Co dinh Ha Noi
            '02437197965' => 123,
            '02438283841' => 12,
            '02437197937' => 234,
            '02438327156' => 13,
            '02436614675' => 20,
            '02437169018' => 6546,
            '02435740123' => 4,
            '02435185921' => 565,
            '02436337012' => 43,
            '02435637828' => 54,
            '02438628825' => 67,
            '02435636839' => 89,
            '02436244060' => 434,
            '02437160998' => 23,
            '02435145398' => 45,
            '02436273077' => 989,
            '02438561099' => 456,
            '02435522771' => 435,
            '02438252780' => 34,
            '02438644524' => 76,
        ];
        debug('<h1>Co dinh Ha Noi (Noi hat)</h1>');
        foreach ($phones as $phone => $sec) {
            $phone_charge = PhoneCharge::getInstance($this->config)->phone_charged($phone, $sec);
            debug("Thoi gian {$sec} (s): Cost: {$phone_charge} (vnd)");
            debug("==============================================================================================");
        }
        $phones = [
            '01236796815' => 130,
            '01236796814' => 208,
            '01248930748' => 45,
            '01259653802' => 21,
            '01271947302' => 105,
            '01290854983' => 47,
            '0917654890' => 11,
            '0948239597' => 16,
            '0883429697' => 35,
            '0967483920' => 121,
            '0978327501' => 12,
            '0988493284' => 85,
            '01620294581' => 678,
            '01631039274' => 45,
            '01645673804' => 65,
            '01651943275' => 45,
            '01660907043' => 34,
            '01678347249' => 56,
            '01680194823' => 89,
            '01699438264' => 23,
            '0864820397' => 34,
            '0904829045' => 54,
            '0930918254' => 556,
            '0891823640' => 432,
            '01208237456' => 23,
            '01211029384' => 245,
            '01221092837' => 56,
            '01260192856' => 76,
            '01286758039' => 83,
            '0920984321' => 56,
            '01885869308' => 49,
            '01868485867' => 37,
            '0992041899' => 78,
            '01991039186' => 76,
        ];
        debug('<h1>Di dong</h1>');
        foreach ($phones as $phone => $sec) {
            $phone_charge = PhoneCharge::getInstance($this->config)->phone_charged($phone, $sec);
            debug("Thoi gian {$sec} (s): Cost: {$phone_charge} (vnd)");
            debug("==============================================================================================");
        }

        $phones = [
            // Co dinh Lien tinh
            '0763738140' => 1,
            '0763958929' => 1,
            '0763891191' => 1,
            '0763815793' => 1,
            '0763506168' => 1,
            '0763708169' => 1,
            '0763571216' => 1,
            '0763519094' => 1,
            '0763562557' => 1,
            '0763826558' => 1,
            '025238730712' => 1,
            '025233873139' => 1,
            '025233775152' => 1,
            '025233773258' => 1,
            '025237715788' => 1,
            '025237715956' => 1,
            '025237870056' => 1,
            '025237755345' => 1,
            '025237734577' => 1,
            '025233873071' => 1,
            '02838549986' => 1,
            '02838379483' => 1,
            '02838358646' => 1,
            '02838951016' => 1,
            '02838203207' => 1,
            '02838591600' => 1,
            '02838584564' => 1,
            '02838416706' => 1,
            '02838320193' => 1,
            '02838260168' => 1,
            '02363743403' => 1,
            '02363734378' => 1,
            '02363736239' => 1,
            '02363744112' => 1,
            '02363642542' => 1,
            '02363744284' => 1,
            '02363743754' => 1,
            '02363736721' => 1,
            '02363698250' => 1,
            '02363733155' => 1,
            '02543894340' => 1,
            '02543610777' => 1,
            '02543565656' => 1,
            '02543582365' => 1,
            '02543582361' => 1,
            '02543572752' => 1,
            '02543572703' => 1,
            '02543572743' => 1,
            '02543593062' => 1,
            '02543593065' => 1,
            '07803867199' => 1,
            '07803831052' => 1,
            '07803863659' => 1,
            '07803826275' => 1,
            '07803507350' => 1,
            '07803872532' => 1,
            '07803504268' => 1,
            '07803894177' => 1,
            '07803860138' => 1,
            '07803886226' => 1,
            '02763387201' => 1,
            '02763646644' => 1,
            '02763621739' => 1,
            '02763646961' => 1,
            '02763374604' => 1,
            '02763374663' => 1,
            '02763374720' => 1,
            '02763387136' => 1,
            '02763387198' => 1,
            '02763374656' => 1,
            '02373630040' => 1,
            '02373630104' => 1,
            '02373869586' => 1,
            '02373633155' => 1,
            '02373630222' => 1,
            '02373630200' => 1,
            '02373633223' => 1,
            '02373630109' => 1,
            '02373510051' => 1,
            '02373877877' => 1,
            '0753875118' => 1,
            '0753829490' => 1,
            '0753854168' => 1,
            '0753874667' => 1,
            '0753871338' => 1,
            '0753854205' => 1,
            '0753854210' => 1,
            '0753871335' => 1,
            '0753866752' => 1,
            '0753849150' => 1,
            '0753861434' => 1,
            '07103835362' => 1,
            '07103859130' => 1,
            '07103859102' => 1,
            '07103862211' => 1,
            '07103851923' => 1,
            '07103864280' => 1,
            '07103689419' => 1,
            '07103689609' => 1,
            '07103856309' => 1,
            '07103856028' => 1,
            '02723821019' => 1,
            '02723987400' => 1,
            '02723987486' => 1,
            '02723986609' => 1,
            '02723987485' => 1,
            '02723985610' => 1,
            '02723987438' => 1,
            '02723986546' => 1,
            '02723987437' => 1,
            '02723986027' => 1,
            '02383567433' => 1,
            '02383844231' => 1,
            '02383536685' => 1,
            '02383585046' => 1,
            '02383532504' => 1,
            '02383885123' => 1,
            '02383841765' => 1,
            '02383568908' => 1,
            '02383567286' => 1,
            '02383854171' => 1,
            '02563946111' => 1,
            '02563748128' => 1,
            '02563633877' => 1,
            '02563633925' => 1,
            '02563633907' => 1,
            '02563633894' => 1,
            '02563633857' => 1,
            '02563633829' => 1,
            '02563633864' => 1,
            '02563633856' => 1,
            '02513778393' => 1,
            '02513361241' => 1,
            '02513626912' => 1,
            '02513361266' => 1,
            '02513631545' => 1,
            '02513630654' => 1,
            '02513385175' => 1,
            '02513363930' => 1,
            '02513385321' => 1,
            '02513363139' => 1,
            '02703934254' => 1,
            '02703977342' => 1,
            '02703975038' => 1,
            '02703940361' => 1,
            '02703912152' => 1,
            '02703912235' => 1,
            '02703711120' => 1,
            '02703829686' => 1,
            '02703914350' => 1,
            '02703948627' => 1,
            '02343961144' => 1,
            '02343855066' => 1,
            '02343851816' => 1,
            '02343854846' => 1,
            '02343536439' => 1,
            '02343851998' => 1,
            '02343852406' => 1,
            '02343855250' => 1,
            '02343954907' => 1,
            '02343961112' => 1,
            '02743642888' => 1,
            '02743626794' => 1,
            '02743773026' => 1,
            '02743557280' => 1,
            '02743774998' => 1,
            '02743381707' => 1,
            '02743912301' => 1,
            '02743381744' => 1,
            '02743381709' => 1,
            '02743381720' => 1,
            '02773963028' => 1,
            '02773910300' => 1,
            '02773910033' => 1,
            '02773910041' => 1,
            '02773980011' => 1,
            '02773980000' => 1,
            '02773980012' => 1,
            '02773980030' => 1,
            '02773980025' => 1,
            '02773980019' => 1,
            '02733819528' => 1,
            '02736262888' => 1,
            '02733944765' => 1,
            '02733946093' => 1,
            '02733944871' => 1,
            '02733947739' => 1,
            '02733946019' => 1,
            '02733943101' => 1,
            '02733945892' => 1,
            '02733945120' => 1,
            '02033681883' => 1,
            '02033681885' => 1,
            '02033681892' => 1,
            '02033873651' => 1,
            '02033681907' => 1,
            '02033681889' => 1,
            '02033681895' => 1,
            '02033681897' => 1,
            '02033681887' => 1,
            '02033685076' => 1,
            '06513958009' => 1,
            '06513885029' => 1,
            '06513885423' => 1,
            '06513819964' => 1,
            '06513870040' => 1,
            '06513634082' => 1,
            '06513819636' => 1,
            '06513563445' => 1,
            '06513634706' => 1,
            '06513650913' => 1,
            '0583740011' => 1,
            '0583822090' => 1,
            '0583867362' => 1,
            '0583831168' => 1,
            '0583881398' => 1,
            '0583543763' => 1,
            '0583890166' => 1,
            '0583831522' => 1,
            '0583725035' => 1,
            '0583823270' => 1,
            '02353669107' => 1,
            '02353726008' => 1,
            '02353673121' => 1,
            '02353669732' => 1,
            '02353368719' => 1,
            '02353674231' => 1,
            '02353367442' => 1,
            '02353367445' => 1,
            '02353366894' => 1,
            '02353365606' => 1,
            '02283741024' => 1,
            '02283636689' => 1,
            '02283640083' => 1,
            '02283645342' => 1,
            '02283636343' => 1,
            '02283640309' => 1,
            '02283641219' => 1,
            '02283635402' => 1,
            '02283640922' => 1,
            '02283647151' => 1,
            '0773829059' => 1,
            '0773810971' => 1,
            '0773560067' => 1,
            '0773885219' => 1,
            '0773826936' => 1,
            '0773885014' => 1,
            '0773663167' => 1,
            '0773663159' => 1,
            '0773829201' => 1,
            '0773829589' => 1,
            '02253679931' => 1,
            '02253881764' => 1,
            '02253887908' => 1,
            '02253774759' => 1,
            '02253888713' => 1,
            '02253871211' => 1,
            '02253560400' => 1,
            '02253581684' => 1,
            '02253770527' => 1,
            '02253861092' => 1,
        ];
        debug('<h1>Co dinh (Lien tinh)</h1>');
        foreach ($phones as $phone => $sec) {
            $phone_charge = PhoneCharge::getInstance($this->config)->phone_charged($phone, $sec);
            debug("Thoi gian {$sec} (s): Cost: {$phone_charge} (vnd)");
            debug("==============================================================================================");
        }
        exit();
    }
}
