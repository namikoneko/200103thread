{include file="header.tpl"}

<div class="container">

    <button id="openBtn" class="button button-primary">open</button><br>

{include file="title_search.tpl"}

    <a class="button button-primary" href='title' class='button'>return To Title</a>
    <a class="button button-primary" href='https://xrea.yaguchineko.work/190429/index.cgi' class='button'>url to title</a>
   <a class="button button-primary" href='http://tadasukeneko.php.xdomain.jp/200103/thread/172' class='button'>カテゴリー</a>

    <div class="grid">
    {foreach from=$rows item=row}
    	<div class="item">
		<a href="thread/{$row.id}">{$row.title}</a>
    		<a class="upLink" href="title_up/{$row.id}">up</a>
    		<!--<a class="button" href="title_up/{$row.id}">up</a>-->
	</div>
	<!--
    	<div class="item"><a href="title_upd/{$row.id}">update</a></div>
    	<div class="item"><a href="title_del/{$row.id}">delete</a></div>
	-->
    {/foreach}
    </div>
</div><!--container-->

{include file="footer.tpl"}
