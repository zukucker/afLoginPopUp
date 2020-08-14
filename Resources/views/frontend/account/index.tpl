{extends file="parent:frontend/account/index.tpl"}
{block name="frontend_index_javascript_async_ready"}
{$smarty.block.parent}
{if $afLoginPopUp}
{debug}
<!-- The Modal -->
<div id="accountModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Kundengruppe: {$sUserData.additional.user.customergroup}</p>
    <p>Rechnungsland: {$sUserData.additional.country.countryname}</p>
  </div>

</div>

<script>
var modal = document.getElementById('accountModal');
var span = document.getElementsByClassName("close")[0];

span.onclick = function(){
    modal.style.display = "none";
};

// close function if click outside
window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    }
}

function open(){
    modal.style.display = "block";
}

open();
</script>
{/if}
{/block}
