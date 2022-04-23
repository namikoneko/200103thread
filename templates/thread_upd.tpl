{include file="header.tpl"}

<div class="container">
    <form action='../../thread_upd_exe' method='post'>

	<input type='hidden' name='id' value={$id}><br>
	<input type='hidden' name='thread_id' value={$row.id}><br>
	        <textarea class="updtextarea" name='text'>{$row.text}</textarea><br>
	<input class="button button-primary" type='submit' value='send'>

    </form>
    <!--
    -->
</div>

{include file="footer.tpl"}
