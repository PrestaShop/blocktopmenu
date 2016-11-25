{function name="blocktopmenu_menu" items=array()}
	{foreach $items as $item}
	<li {if $item.selected}class="sfHover"{/if}>
		<a href="{$item.data.link}" title="{$item.data.name}">{$item.data.name}</a>
		{if $item|count > 0}
		<ul>
			{blocktopmenu_menu items=$item.children}
			{if $item.type == 'category-thumbnails'}
            <li class="category-thumbnail">
				{foreach $item.images as $image}
				<div>
					<img class="imgm" src="{$image.src}" alt="{$image.alt}" title="{$image.title}" />
				</div>
				{/foreach}
			</li>
            {/if}
		</ul>
		{/if}
	</li>
	{/foreach}
{/function}

{if $items|count > 0}
<div class="sf-contener clearfix">
	<ul class="sf-menu clearfix">
		{$MENU}
		{* {blocktopmenu_menu items=$items} *}
		{if $MENU_SEARCH}
		<li class="sf-search noBack" style="float:right">
			<form id="searchbox" action="{$link->getPageLink('search')|escape:'html'}" method="get">
				<p>
					<input type="hidden" name="controller" value="search" />
					<input type="hidden" value="position" name="orderby"/>
					<input type="hidden" value="desc" name="orderway"/>
					<input type="text" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|escape:'html':'UTF-8'}{/if}" />
				</p>
			</form>
		</li>
		{/if}
	</ul>
</div>
<div class="sf-right">&nbsp;</div>
{/if}