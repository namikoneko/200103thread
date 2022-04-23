{include file="header.tpl"}
<div class="container">
    <div class="return_btn">
    <a class="button button-primary" href='../title' class='button'>return To Title</a>
    <a class="button button-primary" href='https://xrea.yaguchineko.work/190429/index.cgi' class='button'>url to title</a>
    <a class="button button-primary" href='http://tadasukeneko.php.xdomain.jp/200103/thread/172' class='button'>カテゴリー</a>

    </div>
    <div class="threadTitle"> 
    {$title_row.title}<br>
    <a class="" href="../title_upd/{$title_row.id}">update</a>
    <a class="" href="../title_del/{$title_row.id}">delete</a>
    <a class="upLink" href="../thread_title_up/{$title_row.id}">up</a>
    </div>

    <form action='../thread_ins_exe' method='post'>
	<input type='hidden' name='id' value='{$title_row.id}'>
	<textarea class="myTextarea" name='text'></textarea><br>
	<input class="button button-primary" type='submit' value='send'>
    </form>
    {foreach from=$rows item=row}
    <div id="{$row.id}" class="threadItem"> 
        <div class="threadItemContent">{$row.text}</div>
        <a class="" href="../thread_upd/{$title_row.id}/{$row.id}">update</a>
        <a class="" href="../thread_del/{$title_row.id}/{$row.id}">delete</a>
        <a class="upLink" href="../thread_up/{$title_row.id}/{$row.id}">up</a>
        <span class="threadItemDate">{$row.date}</span>        
        <span class="threadItemRowid">NO.{$row.id}</span>
    </div>
    {/foreach}
    <!--
    -->
</div><!--container-->
{include file="footer.tpl"}
