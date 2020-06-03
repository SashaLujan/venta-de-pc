{include 'headerAdmin.tpl'}
    <div class="container">
        <h1>Inserte una computadora</h1>
        <form action="guardarComp" method="post" class="my-4">
            <div class="form-group">
                <label>computadora</label>
               <select name="id_computadora" type="text" class="form-control" >
                {foreach from=$listaComp item=computadora} 
                    <option value={$computadora>id_computadora}>{$computadora>nombre}</option>
                {/foreach}
            </select>
            </div>
            <div class="form-group">
                <label>nombre</label>
                <input name="nombre" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>marca</label>
                <input name="marca" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>sistema operativo</label>
                <input name="sistOperativo" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>marca</label>
               <select name="id_marca-fk" type="text" class="form-control" >
                {foreach from=$listaMarca item=marca} 
                    <option value={$marca>id_marca}>{$marca>nombre}</option>
                {/foreach}
            </select>
            </div>
            <button type="submit" class="btn btn-danger">Guardar</button>
            <a class="btn btn-danger" href="listaComp"><b>Volver</b></a>;
        </form>
    </div>

{include 'templates/footer.tpl'}