<div 
  class="modal fade" 
  id="modalAddEarn" 
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

      <form action="#" data-flow="E">
        <div class="modal-body">
          <div class="field-list">

            <div class="item">
              <label for="accountAddEarn">Conta</label>

              <select class="selectAccount" name="account_id" id="accountAddEarn">
              </select>
            </div>

            <div class="item">
              <label for="categoryAddEarn">Categoria</label>

              <select class="selectCategory" name="category_id" id="categoryAddEarn">
              </select>
            </div>
        
            <div class="item">
              <label for="valueAddEarn">Valor</label>

              <input 
                type="text" 
                class="money" 
                name="value"
                aria-label="Amount (to the nearest dollar)" 
                step="0.01"
                id="valueAddEarn"
                required
              >

              <div class="valueError invalid-feedback"></div>
            </div>

            <div class="item">
              <label for="statusAddEarn">Status</label>

              <select name="status_id" id="statusAddEarn">
                <option value="2">Concluido</option>
                <option value="1">Pendente</option>
              </select>
            </div>

            <div class="item">
              <label for="descAddEarn">Descrição (opcional)</label>

              <textarea name="description" id="description" rows="2"></textarea>
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