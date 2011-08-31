{include file="../common/header.tpl"}

<table border=0 cellspacing=1 cellpadding=4 width=600>
 <tr>
  <th width=60 bgcolor=#CC0000 align=center>No.</th>
  <th width=300 bgcolor=#CC0000 align=center>Subject</th>
  <th width=80 bgcolor=#CC0000 align=center>Author</th>
  <th width=120 bgcolor=#CC0000 align=center>Date</th>
  <th width=60 bgcolor=#CC0000 align=center>Hit</th>
 </tr>

{foreach from=$post item="post"}
 <tr>
  <td bgcolor=#FFFFFF align=right style="font-size:8pt;">{$post.id}</td>
  <td bgcolor=#FFFFFF align=left><a href="?action={$action.view}&pid={$post.id}">{$post.title}</a></td>
  <td bgcolor=#FFFFFF align=center>{$post.user.name}</td>
  <td bgcolor=#FFFFFF align=center style="font-size:8pt;">{$post.dateReg|date_format:"%Y-%m-%d %H:%M:%S"}</td>
  <td bgcolor=#FFFFFF align=center style="font-size:8pt;">{$post.accessed}</td>
 </tr>
{foreachelse}
 <tr>
  <td colspan=5 bgcolor=#FFFFFF align=center valign=middle>There's no post</td>
 </tr>
{/foreach}

 <tr>
  <td colspan=5 bgcolor=#FFFFFF align=center>
{$pager}
  </td>
 </tr>
 <tr>
  <td colspan=5 bgcolor=#FFFFFF align=right>
   <a href="?action={$action.registerForm}&bid={$board.id}">New Article</a>
  </td>
 </tr>
</table>

{include file="../common/footer.tpl"}