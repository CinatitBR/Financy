<div 
  class="modal fade" 
  id="modalAddAccount" 
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

      <form action="#">
        <div class="modal-body">
          <div class="success valid-feedback"></div>

          <div class="field-list">

            <div class="item">
              <label for="nameAddAccount">Nome da conta</label>

              <input 
                type="text" 
                name="account_name" 
                id="nameAddAccount" 
                maxlength="100" 
                required 
              />

              <div class="account_nameError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="valueAddAccount">Valor inicial</label>

              <input 
                type="text" 
                class="money" 
                name="value"
                id="valueAddAccount"
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