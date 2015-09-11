{function name="menu" nodes=[] depth=0}
  {if $nodes|count}
    <ul class="menu" data-depth="{$depth}">
      {foreach from=$nodes item=node}
        <li class="{$node.type}">
          <a href="{$node.url}" {if $node.open_in_new_window} target="_blank" {/if}>{$node.label}</a>
          {menu nodes=$node.children depth=$node.depth}
          {if $node.image_urls|count}
            <div class="menu-images-container">
              {foreach from=$node.image_urls item=image_url}
                <img src="{$image_url}">
              {/foreach}
            </div>
          {/if}
        </li>
      {/foreach}
    </ul>
  {/if}
{/function}

{menu nodes=$menu.children}
