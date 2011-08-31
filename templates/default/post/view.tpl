{include file="../common/header.tpl"}

<table bgcolor=#CCCCCC border=0 cellspacing=1 cellpadding=4 width=600>
 <tr>
  <td width=100 bgcolor=#CC0000 align=right class=whitefont>Author</td>
  <td width=500 bgcolor=#FFFFFF align=left>{$post.user.name}</td>
 </tr>
 <tr>
  <td bgcolor=#CC0000 align=right class=whitefont>Subject</td>
  <td bgcolor=#FFFFFF align=left>{$post.title}</td>
 </tr>
 <tr>
  <td colspan=2 bgcolor=#FFFFFF>
{$post.content}
  </td>
 </tr>
 <tr>
  <td colspan=2 bgcolor=#CC0000 align="right" class="whitefont">
   <a href="?action={$action.list}&bid={$board.id}&pid={$post.id}" class="whitefont">List</a>
   <a href="?action={$action.registerForm}&bid={$board.id}&ppid={$post.id}" class="whitefont">Reply</a>
   <a href="?action={$action.modifyForm}&bid={$board.id}&pid={$post.id}" class="whitefont">Modify</a>
   <a href="?action={$action.deleteForm}&bid={$board.id}&pid={$post.id}" class="whitefont">Delete</a>
  </td>
 </tr>
</table>

{include file="../common/footer.tpl"}