<div 
  class="modal fade" 
  id="modal_add_earn" 
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" style="color: var(--green);">
          Adicionar ganho
        </h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="#" data-flow="E" class="form-payment">
        <div class="modal-body">
          <div class="success valid-feedback"></div>

          <div class="field-list">

            <div class="item">
              <label for="account_add_earn">Conta</label>

              <select class="select-account" name="account_id" id="account_add_earn">
              </select>

              <div class="accountError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="category_add_earn">Categoria</label>

              <select class="select-category" name="category_id" id="category_add_earn">
              </select>

              <div class="categoryError invalid-feedback"></div>
            </div>
        
            <div class="item">
              <label for="value_add_earn">Valor</label>

              <input 
                type="text" 
                class="money" 
                name="value"
                aria-label="Amount (to the nearest dollar)" 
                step="0.01"
                id="value_add_earn"
                required
              >

              <div class="valueError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="status_add_earn">Status</label>

              <select name="status_id" id="status_add_earn">
                <option value="2">Concluido</option>
                <option value="1">Pendente</option>
              </select>

              <div class="statusError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="desc_add_earn">Descrição (opcional)</label>

              <textarea name="description" id="desc_add_earn" rows="2"></textarea>

              <div class="descError invalid-feedback"></div>
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