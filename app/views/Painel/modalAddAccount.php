<div 
  class="modal fade" 
  id="modal_add_account" 
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" style="color: var(--brown);">
          Adicionar conta
        </h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="#" id="form_add_account">
        <div class="modal-body">
          <div class="success valid-feedback"></div>

          <div class="field-list">

            <div class="item">
              <label for="name_add_account">Nome da conta</label>

              <input 
                type="text" 
                name="account_name" 
                id="name_add_account" 
                maxlength="100" 
                required 
              />

              <div class="account_nameError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="value_add_account">Valor inicial</label>

              <input 
                type="text" 
                class="money" 
                name="value"
                id="value_add_account"
                step="0.01"
                required
              >

              <div class="valueError invalid-feedback"></div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button 
            type="button" 
            class="btn btn-secondary" 
            data-dismiss="modal"
          >
            Fechar
          </button>

          <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
      </form>

    </div>
  </div>
</div>