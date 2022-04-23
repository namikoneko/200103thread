{include file="header.tpl"}

<div class="container">

<form class="myForm" action='../title_upd_exe' method='post'>
    <input type='hidden' name='id' value="{$row.id}">
    <input class="inputText" type='text' name='title' value="{$row.title}"><br>
    <input class="button button-primary" type='submit' value='send'>
</form>
    <!--
    -->
</div><!--container-->

{include file="footer.tpl"}
