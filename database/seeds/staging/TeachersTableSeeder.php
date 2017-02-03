<?php

namespace Database\Seeds\Staging;

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teachers')->delete();
        
        \DB::table('teachers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '测试老师1',
                'email' => 'test@sudo.team',
                'password' => '$2y$10$9ZMTG1WavDPnCZ9VTmnllevZyrlSwUGcYO/Uhe.Al6dvEcSbYLcO.',
                'remember_token' => NULL,
                'description' => 'Doloremque illo repellendus at eos quis nostrum. Enim sunt cupiditate amet in earum aut. Aperiam necessitatibus magni laborum quo.',
                'teaching_since' => NULL,
                'unit_price' => 99.0,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-08-05 10:57:20',
                'deleted_at' => '2016-08-05 10:57:20',
                'avatar_file_name' => NULL,
                'avatar_file_size' => NULL,
                'avatar_content_type' => NULL,
                'avatar_updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '付婷',
                'email' => 'futing@163.com',
                'password' => '',
                'remember_token' => NULL,
                'description' => '',
                'teaching_since' => '2004-11-30 00:00:00',
                'unit_price' => 39.0,
                'enabled' => 1,
                'created_at' => '2016-08-05 10:26:33',
                'updated_at' => '2016-09-19 11:19:06',
                'deleted_at' => NULL,
                'avatar_file_name' => 'smile.jpg',
                'avatar_file_size' => 336951,
                'avatar_content_type' => 'image/jpeg',
                'avatar_updated_at' => '2016-08-05 10:47:11',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '侯雪莹',
                'email' => 'houxueying@163.com',
                'password' => '',
                'remember_token' => NULL,
                'description' => '汉语国际教育专业，并拥有汉语国际教育教师资格证，雅思9分。
六年青少英语教学经验，精通多个版本的公立学校教材，对于内容重点的把握精准。
擅长听说和阅读专项提高，采用双语教学法，营造真实语言环境。自建阅读体系和方法，注重解题技巧的培养，用独特的方法让学生轻松理解文章含义，建立英语思维，进而获得自主学习能力。
授课方式灵活多样，善于用语言打动学生，根据学生不同的情况，因材施教，确保每一个学生都可以收获更多。
',
                
                'teaching_since' => '2009-11-30 00:00:00',
                'unit_price' => 39.0,
                'enabled' => 1,
                'created_at' => '2016-08-05 10:46:37',
                'updated_at' => '2016-08-05 11:13:32',
                'deleted_at' => NULL,
                'avatar_file_name' => '84782244686673904.jpg',
                'avatar_file_size' => 41587,
                'avatar_content_type' => 'image/jpeg',
                'avatar_updated_at' => '2016-08-05 11:09:55',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '许萌',
                'email' => 'xumeng@163.com',
                'password' => '',
                'remember_token' => NULL,
                'description' => '毕业于北京林业大学，六年英语教学经验，教授新概念，KET，PET和语法系统。
精通词汇、语法和听说，采用三位一体的教学模式，实现英语能力的全面提升，告别不敢说、怕说错的胆怯心理，向学生诠释“说英语，真的很简单”。讲语法的难点和重点融入到听说中，通过“学以致用”的方式，达到熟练。
课堂氛围活泼，趣味横生，每一个知识点都加入幽默元素，以达到充分理解，轻松记忆，最终实现快乐学习。许老师的人生格言是“快乐学习，学习才能更快乐”。
',
                
                'teaching_since' => '2009-11-30 00:00:00',
                'unit_price' => 49.0,
                'enabled' => 1,
                'created_at' => '2016-08-05 10:57:09',
                'updated_at' => '2016-08-05 11:14:21',
                'deleted_at' => NULL,
                'avatar_file_name' => 'lin.jpg',
                'avatar_file_size' => 330523,
                'avatar_content_type' => 'image/jpeg',
                'avatar_updated_at' => '2016-08-05 11:14:16',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => '王密',
                'email' => 'wangmi@163.com',
                'password' => '',
                'remember_token' => NULL,
                'description' => '毕业于湖北民族学院，五年英语教学经验，精通自然拼读、三一口语、新概念和语法等。
王老师喜欢双语教学模式，更容易给学生营造语言环境，边听边说，轻松建立英语思维。自然拼读加三一口语，是王老师的金牌组合课程，全面强化英语听说能力。语法精讲精练课程，帮助零基础学生以最少的时间掌握最多的内容，实现高效学习。对于提高班学生，强化课本考点和重点，传授语法技巧，在考试中处于不败之地。
激情教学风格，用轻松幽默的方式传递英语之美。慷慨激昂的演说，无时不刻为同学们提供正能量。
',
                
                'teaching_since' => '2010-11-30 00:00:00',
                'unit_price' => 45.0,
                'enabled' => 1,
                'created_at' => '2016-08-05 11:01:18',
                'updated_at' => '2016-08-05 11:18:47',
                'deleted_at' => NULL,
                'avatar_file_name' => 'abby.jpg',
                'avatar_file_size' => 418425,
                'avatar_content_type' => 'image/jpeg',
                'avatar_updated_at' => '2016-08-05 11:01:40',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '奚泉',
                'email' => 'xiquan@163.com',
                'password' => '',
                'remember_token' => NULL,
                'description' => '毕业于辽宁对外经贸学院，五年英语教学经验，主讲三一口语、自然拼读和剑桥英语等。
发音标准，擅长口语、听力和语法教学。听是输入，说是输出，二者相结合使学生敢于开口说英语，将考点和技巧融入其中，实现学以致用。语法学习的核心是理解，非机械记忆，奚老师传递理解至上的理念，知其然知其所以然，所教学生考试成绩提高迅速。
幽默型授课风格，极富有感染力的语言，激发学生学习英语的兴趣。推崇兴趣教学法，建立兴趣是成功一半，提高学生的自学能力。
',
                'teaching_since' => '2010-11-30 00:00:00',
                'unit_price' => 40.0,
                'enabled' => 1,
                'created_at' => '2016-08-05 11:02:23',
                'updated_at' => '2016-08-05 11:18:51',
                'deleted_at' => NULL,
                'avatar_file_name' => 'lexy.jpg',
                'avatar_file_size' => 421113,
                'avatar_content_type' => 'image/jpeg',
                'avatar_updated_at' => '2016-08-05 11:03:10',
            ),
            6 =>
            array (
                'id' => 8,
                'name' => '测试老师2',
                'email' => 'test@test.teacher',
                'password' => '',
                'remember_token' => NULL,
                'description' => 'Test.',
                'teaching_since' => '2000-11-30 00:00:00',
                'unit_price' => 10.0,
                'enabled' => 0,
                'created_at' => '2017-01-12 23:54:24',
                'updated_at' => '2017-01-12 23:54:24',
                'deleted_at' => NULL,
                'avatar_file_name' => NULL,
                'avatar_file_size' => NULL,
                'avatar_content_type' => NULL,
                'avatar_updated_at' => NULL,
            ),
        ));

    }
}