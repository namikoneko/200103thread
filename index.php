<?php
ini_set('display_errors', "On");

require '../flight/Flight.php';
require_once '../idiorm.php';
ORM::configure('sqlite:./sqlite.db');
ORM::configure('return_result_sets', true);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Parsedown.php');
require_once '../libs/Smarty.class.php';

Flight::register('view', 'Smarty', array(), function($smarty){
	$smarty->template_dir = "./templates";
	$smarty->compile_dir = "./templates_c";
});

// title_list ##################################################
Flight::route('/title', function(){
	$rows = ORM::for_table('title')->order_by_desc('updated')->find_result_set();

	Flight::view()->assign("rows",$rows);
	Flight::view()->display("title.tpl");
});

// title_search ##################################################
Flight::route('/title_search', function(){
    $title_search = Flight::request()->data->title_search;
    $rows = ORM::for_table('title')->where_like('title',"%$title_search%")->order_by_desc('updated')->find_many();

	Flight::view()->assign("rows",$rows);
	//Flight::view()->assign("topLink",1);
	Flight::view()->display("title.tpl");
});

// thread_search ##################################################
Flight::route('/thread_search', function(){
    $thread_search = Flight::request()->data->thread_search;
    $rows = ORM::for_table('thread')->where_like('text',"%$thread_search%")->order_by_desc('updated')->find_many();

    $title_rows = [];
    $thread_rows = [];

        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $Parsedown->setBreaksEnabled(true);

    foreach($rows as $row){

        $row['text'] = $Parsedown->text($row['text']);
        $thread_rows[] = $row;
	$title_rows[] = ORM::for_table('title')->find_one($row['title_id']);
    }

	Flight::view()->assign("title_rows",$title_rows);
	Flight::view()->assign("thread_rows",$thread_rows);
	//Flight::view()->assign("topLink",1);
	Flight::view()->display("thread_search.tpl");
});

// title_up ##################################################
Flight::route('/title_up/@id', function($id){
	$result = ORM::for_table('title')->find_one($id);
	$result->updated = time();
	$result->save();
	Flight::redirect('/title');
});

// title_ins_exe ##################################################
Flight::route('/title_ins_exe', function(){
    $result = ORM::for_table('title')->create();
    $result->title = Flight::request()->data->title;
    $result->date = date('Y-m-d');
    $result->updated = time();
    $result->save();
    Flight::redirect('/title');
});

// title_upd ##################################################
Flight::route('/title_upd/@id', function($id){
    $row = ORM::for_table('title')->find_one($id);
    Flight::view()->assign("row",$row);
    Flight::view()->display("title_upd.tpl");
});

// title_upd_exe ##################################################
Flight::route('/title_upd_exe', function(){
    $id = Flight::request()->data->id;
    $result = ORM::for_table('title')->find_one($id);
    $title = Flight::request()->data->title;
    $result->title = $title;
    $result->save();
    //Flight::redirect('/title');
    Flight::redirect('/thread/' . $id);
});

// thread_list ##################################################
Flight::route('/thread/@id', function($id){
    $title_row = ORM::for_table('title')->find_one($id);
    Flight::view()->assign("title_row",$title_row);

    $rows = ORM::for_table('thread')->where('title_id',$id)->order_by_desc('updated')->find_many();
    $Parsedown = new Parsedown();
    $Parsedown->setMarkupEscaped(true);
    $Parsedown->setBreaksEnabled(true);
    foreach($rows as $row){
        $row['text'] = $Parsedown->text($row['text']);
    }
    Flight::view()->assign("rows",$rows);
    Flight::view()->display("thread_list.tpl");
});

// thread_up ##################################################
flight::route('/thread_up/@id/@threadid', function($id,$threadid){
	$result = orm::for_table('thread')->find_one($threadid);
	$result->updated = time();
	$result->save();
	flight::redirect('/thread/' . $id);
});

// thread_title_up ##################################################
flight::route('/thread_title_up/@id', function($id){
	$result = orm::for_table('title')->find_one($id);
	$result->updated = time();
	$result->save();
	flight::redirect('/thread/' . $id);
});

// thread_ins_exe ##################################################
Flight::route('/thread_ins_exe', function(){
    $id = Flight::request()->data->id;
    $result = ORM::for_table('thread')->create();
    $result->date = date('Y-m-d');
    $result->title_id = $id;
    $result->text = Flight::request()->data->text;
    $result->updated = time();
    $result->save();
    Flight::redirect('/thread/' . $id);
});

// thread_upd ##################################################
Flight::route('/thread_upd/@id/@threadId', function($id,$threadId){
    $row = ORM::for_table('thread')->find_one($threadId);
    Flight::view()->assign("id",$id);
    Flight::view()->assign("row",$row);
    Flight::view()->display("thread_upd.tpl");
});

// thread_upd_exe ##################################################
Flight::route('/thread_upd_exe', function(){
	$result = ORM::for_table('thread')->find_one(Flight::request()->data->thread_id);
	$result->text = Flight::request()->data->text;
	$result->save();
	Flight::redirect('/thread/' . Flight::request()->data->id);
});

// title_del ##################################################
Flight::route('/title_del/@id', function($id){
	$result = ORM::for_table('title')->find_one($id);
	$result->delete();
	Flight::redirect('/title');
});

// thread_del ##################################################
Flight::route('/thread_del/@id/@threadId', function($id,$threadId){
	$result = ORM::for_table('thread')->find_one($threadId);
	$result->delete();
	Flight::redirect('/thread/' . $id);
});

// smarty_test ##################################################
Flight::route('/s', function(){

	Flight::view()->assign("now",time());
	Flight::view()->display("sample.tpl");

	Flight::map('render', function($template, $data){
    		Flight::view()->assign($data);
    		Flight::view()->display($template);
	});

});
/*
	*/

// test ##################################################
Flight::route('/test', function(){
    //$text = ORM::for_table('test')->where('id', 1)->find_one();
    //echo $text->text;
    /*
    $text = ORM::for_table('test')->where('id', 2)->find_one();

        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $Parsedown->setBreaksEnabled(true);
  echo $Parsedown->text($text->text);
  echo "hello";
    */
	Flight::view()->assign("now",time());
	Flight::view()->display("sample.tpl");
});

Flight::start();
