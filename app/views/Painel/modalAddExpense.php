<div 
  class="modal fade" 
  id="modal_add_expense" 
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" style="color: var(--red);">
          Adicionar despesa
        </h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="#" data-flow="S" class="form-payment">
        <div class="modal-body">
          <div class="success valid-feedback"></div>

          <div class="field-list">

            <div class="item">
              <label for="account_add_expense">Conta</label>

              <select class="select-account" name="account_id" id="account_add_expense">
              </select>

              <div class="accountError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="category_add_expense">Categoria</label>

              <select class="select-category" name="category_id" id="category_add_expense">
              </select>

              <div class="categoryError invalid-feedback"></div>
            </div>
        
            <div class="item">
              <label for="value_add_expense">Valor</label>

              <input 
                type="text" 
                class="money" 
                name="value"
                aria-label="Amount (to the nearest dollar)" 
                step="0.01"
                id="value_add_expense"
                required
              >

              <div class="valueError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="status_add_expense">Status</label>

              <select name="status_id" id="status_add_expense">
                <option value="2">Concluido</option>
                <option value="1">Pendente</option>
              </select>

              <div class="statusError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="desc_add_expense">Descrição (opcional)</label>

              <textarea name="description" id="desc_add_expense" rows="2"></textarea>

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