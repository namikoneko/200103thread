{include file="header.tpl"}

<div class="container">

{include file="title_search.tpl"}

<a class="button button-primary" href='title' class='button'>return To Title</a>

<div class="row">

    <div class="one-half column">
    {foreach from=$title_rows item=title_row}
        <a href="thread/{$title_row.id}">{$title_row.title}</a><br>
    {/foreach}
    </div>

    <div class="one-half column">
    {foreach from=$thread_rows item=thread_row}
        <div id="{$thread_row.id}">
            {$thread_row.text}<br>
	</div>
    {/foreach}
    </div>

</div>
	<!--
	-->
    </div>
</div><!--container-->

{include file="footer.tpl"}
