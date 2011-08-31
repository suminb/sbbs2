<?
class Pager
{
	var $page;
	var $posts;
	var $pagesPerList;
	var $postsPerList;
	var $query;

	var $strPrevPage = "<< ";
	var $strNextPage = " >>";
	var $strPrefix = "[";
	var $strPostfix = "]";
	var $strHighlightPre = "<b>";
	var $strHighlightPost = "</b>";

	function Pager($page=1, $posts=0, $pagesPerList=10, $postsPerList=15, $query=null)
	{
		$this->page = $page;
		$this->posts = $posts;
		$this->pagesPerList = $pagesPerList;
		$this->postsPerList = $postsPerList;
		$this->query = $query;
	}

	function getStartNo()
	{
		return (($this->page-1) * $this->postsPerList);
	}

	function show()
	{
		echo($this->get());
	}

	function get()
	{
		if(!$this->page) $this->page = 1;
		$startNo = ($this->page-1) * $this->postsPerList;

		$tmp = (int)($this->posts / $this->postsPerList);

		if($this->posts%$this->postsPerList==0)
			$pageNum = $tmp;
		else
			$pageNum = $tmp+1;

		$pageStart = $this->page - ($this->page-1) % $this->pagesPerList;
		$pageEnd = $pageStart + $this->pagesPerList - 1;

		$prevPageList = $pageStart - 1;
		$nextPageList = $pageEnd + 1;

		if($this->page > $this->pagesPerList /* && $pageListCount <= $pageNum*/)
		{
			$pager = sprintf(
				"<a href='?%spage=%d'>%s</a>",
				$this->query, $prevPageList, $this->strPrevPage
			);
		}

		for($i=$pageStart; $i<=$pageEnd; $i++)
		{
			if($i > $pageNum) break;

			if($this->page == $i)
			{
				$pager .= sprintf(
					"%s%s%d%s%s",
					$this->strPrefix, $this->strHighlightPre,
					$i,
					$this->strHighlightPost, $this->strPostfix
				);
			}
			else
			{
				$pager .= sprintf(
					"%s<a href='?%spage=%d'>%d</a>%s",
					$this->strPrefix, $this->query, $i, $i, $this->strPostfix
				);
			}
		}
		if($this->page >= 1 && $nextPageList < $pageNum)
		{
			$pager .= sprintf(
				"<a href='?%spage=%d'>%s</a>",
				$this->query, $nextPageList, $this->strNextPage
			);
		}

		return $pager;
	}
}
?>