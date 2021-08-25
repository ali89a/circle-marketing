<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use App\Models\SupportTicket;
use App\Models\TicketCategory;
use Illuminate\Database\Seeder;
use App\Models\TicketPriorities;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
            [
                'name' => 'Open',
                'color' => '#593f7a'
            ],[
                'name' => 'Close',
                'color' => '#53fc28'
            ]
            );

        TicketStatus::insert($data);

        $data = array(
            [
                'name' => 'Speed Slow'            
            ],[
                'name' => 'Link Down'
            ],[
                'name' => 'Billing Issue'
            ]
        );
        TicketCategory::insert($data);

        $data = array(
                [
                    'name' => 'Normal'
                ],[
                    'name' => 'Medium'
                ],[
                    'name' => 'High'
                ]
            );

        TicketPriorities::insert($data);


        $data = array([
            'support_id' => 1,
            'customer_id' => 1,
            'title' => 'Link speed very slow',
            'problem_details' => 'very solo line',
            'status_id' => 1,
            'category_id' => 1,
            'priority_id' => 1,
            'tokenhas' => md5(1),
            'created_at' => now(),
            'updated_at' => now()
        ],[
            'customer_id' => 1,
            'support_id' => null,
            'title' => 'Link Down',
            'problem_details' => 'Line down for 30 hour',
            'status_id' => 1,
            'category_id' => 1,
            'priority_id' => 1,
            'tokenhas' => md5(1),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportTicket::insert($data);

        DB::statement("INSERT INTO `ticket_comments` (`id`, `ticket_id`, `comment`, `support_id`, `customer_id`, `attachment`, `created_at`, `updated_at`) VALUES
        (2, 1, 'Dear SIr,\r\nWe are working on your issue,', 5, NULL, '[\"162987958415.png\",\"1629879584699.png\"]', '2021-08-25 08:19:44', '2021-08-25 08:19:44'),
        (3, 1, '<p>Hey John,</p><p>wellish laminable ineunt popshop catalyte prismatize campimetrical lentisk excluding portlet coccinellid impestation Bangash Lollardist perameloid procerebrum presume cashmerette washbasin nainsook Odontolcae Alea holcodont welted</p><p>cibarious terrifical uploop naphthaleneacetic containable nonsailor Zwinglian blighty benchful guar porch fallectomy building coinvolve eidolism warmth unclericalize seismographic recongeal ethanethial clog regicidal regainment legific</p>', 5, NULL, '[]', '2021-08-25 08:44:25', '2021-08-25 08:44:25'),
        (4, 1, '<p>Hey John,</p><p>wellish laminable ineunt popshop catalyte prismatize campimetrical lentisk excluding portlet coccinellid impestation Bangash Lollardist perameloid procerebrum presume cashmerette washbasin nainsook Odontolcae Alea holcodont welted</p><p>cibarious terrifical uploop naphthaleneacetic containable nonsailor Zwinglian blighty benchful guar porch fallectomy building coinvolve eidolism warmth unclericalize seismographic recongeal ethanethial clog regicidal regainment legific</p><p>&nbsp;</p><p>&lt;script&gt;alert(\'hi\')&lt;/script&gt;</p>', 5, NULL, '[]', '2021-08-25 08:46:52', '2021-08-25 08:46:52'),
        (6, 1, 'Hello,\r\n\r\nI will check the site loading issue and update you.\r\n\r\nPlease let us know if you need any other help.\r\n\r\n\r\nRegards,\r\nSarika\r\nL3 Support Tech', NULL, 1, '[]', '2021-08-25 09:35:41', '2021-08-25 09:35:41'),
        (7, 2, '<p>Dear Sir,</p><p>We are assigning a new support</p>', 9, NULL, '[]', '2021-08-25 09:49:06', '2021-08-25 09:49:06'),
        (8, 1, '<p>Dear Sir,</p><p>Thanks for your Message,</p><p>Let us check the issue</p>', 9, NULL, '[]', '2021-08-25 09:49:47', '2021-08-25 09:49:47')");
        
        
    }
}
