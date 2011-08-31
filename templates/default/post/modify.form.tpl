{include file="../common/header.tpl"}

<form name="{$form.name}" method="{$form.method}" action="?action={$action.modifyQuery}&bid={$board.id}">
 <input type="hidden" name="bid" value="{$board.id}">

<table bgcolor=#CCCCCC border=0 cellspacing=1 cellpadding=4 width=600>
 <tr>
  <td colspan=2 bgcolor=#CC0000 class=whitefont>:: Register new article</td>
 </tr>

{if $session.uid == 0}
 <tr>
  <td width=100 bgcolor=#CC0000 align=right class=whitefont>Name</td>
  <td width=500 bgcolor=#FFFFFF align=left>
   <input type="text" name="name" value="{$cookie.name}" style="width:100;">
  </td>
 </tr>
 <tr>
  <td bgcolor=#CC0000 align=right class=whitefont>Email</td>
  <td bgcolor=#FFFFFF align=left>
   <input type="text" name="email" value="{$cookie.email}" style="width:300;">
  </td>
 </tr>
 <tr>
  <td bgcolor=#CC0000 align=right class=whitefont>Website</td>
  <td bgcolor=#FFFFFF align=left>
   <input type="text" name="website" value="{$cookie.website}" style="width:300;">
  </td>
 </tr>
 <tr>
  <td bgcolor=#CC0000 align=right class=whitefont>Password</td>
  <td bgcolor=#FFFFFF align=left>
   <input type="password" name="password1" style="width:100;">
   New password:
   <input type="password" name="password2" style="width:100;">
   Confirm:
   <input type="password" name="password3" style="width:100;">
  </td>
 </tr>
{/if}

 <tr>
  <td width=100 bgcolor=#CC0000 align=right class=whitefont>Subject</td>
  <td width=500 bgcolor=#FFFFFF align=left>
   <input type="text" name="title" style="width:100%;">
  </td>
 </tr>

 <tr>
  <td colspan=2 bgcolor=#FFFFFF align=left>
   <textarea name="content" style="width:100%;height:300;">
{$post.content}   
   </textarea>
  </td>
 </tr>

 <tr>
  <td colspan=2 bgcolor=#CC0000 align=right>
   <input type="submit" value="Modify">
  </th>
 </tr>

<!--
 <tr>
  <td bgcolor=#CC0000 align=right></td>
  <td bgcolor=#FFFFFF align=left></td>
 </tr>
-->
</table>

</form>

{include file="../common/footer.tpl"}