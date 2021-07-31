<div class="modal" tabindex="-1" id="fluxel_age_modal" style="z-index: 1041;">
    <div class="modal-dialog">
        <div class="modal-content">
            {if $fluxel_age_modal->text->header}
                <div class="modal-header">
                    <h5 class="modal-title">
                        {$fluxel_age_modal->text->header}
                    </h5>
                </div>
            {/if}
            {if $fluxel_age_modal->text->content}
                <div class="modal-body">
                    {$fluxel_age_modal->text->content}
                </div>
            {/if}
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="fluxel_age_deny">{$fluxel_age_modal->text->deny}</button>
                <button type="button" class="btn btn-success" id="fluxel_age_accept">{$fluxel_age_modal->text->accept}</button>
            </div>
        </div>
    </div>
</div>

<script>
    {literal}
    $(document).ready(function() {
        $('#fluxel_age_modal').modal({
            keyboard: false,
            backdrop: 'static'
        });

        $("#fluxel_age_deny").click(function () {
            {/literal}
            window.location.href = "{$fluxel_age_modal->text->deny_redirect}";
            {literal}
        });

        $("#fluxel_age_accept").click(function () {
            {/literal}
            document.cookie = "{$fluxel_age_modal->cookie}=1; expires={gmdate("D, d M Y H:i:s T", time() + $fluxel_age_modal->cookie_lifetime*24*60*60)}; path=/";
            $("#fluxel_age_modal").modal('hide');
            {literal}
        });
    });
    {/literal}
</script>