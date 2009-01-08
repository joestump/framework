{if strlen($result)}
<h3>{$result}</h3>
{/if}
<form method="post" action="{$smarty.server.REQUEST_URI}">
What is 2 + 2? <input type="text" size="4" name="answer" /> <input type="submit" value="Score!" />
</form>
