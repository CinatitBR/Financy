<div 
  class="modal fade" 
  id="modalAddExpense" 
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

      <form action="#" data-flow="S">
        <div class="modal-body">
          <div class="success valid-feedback"></div>

          <div class="field-list">

            <div class="item">
              <label for="accountAddExpense">Conta</label>

              <select class="accountSelect" name="account_id" id="accountAddExpense">
              </select>
            </div>

            <div class="item">
              <label for="categoryAddExpense">Categoria</label>

              <select class="categorySelect" name="category_id" id="categoryAddExpense">
              </select>
            </div>
        
            <div class="item">
              <label for="valueAddExpense">Valor</label>

              <input 
                type="text" 
                class="money" 
                name="value"
                aria-label="Amount (to the nearest dollar)" 
                step="0.01"
                id="valueAddExpense"
                required
              >

              <div class="valueError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="statusAddExpense">Status</label>

              <select name="status_id" id="statusAddExpense">
                <option value="2">Concluido</option>
                <option value="1">Pendente</option>
              </select>
            </div>

            <div class="item">
              <label for="descAddExpense">Descrição (opcional)</label>

              <textarea name="description" id="descAddExpense" rows="2"></textarea>
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