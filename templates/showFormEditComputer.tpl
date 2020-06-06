{include 'templates/headerAdmin.tpl'}
    <div class="container">  
        <h1>Edite la computadora</h1>
        <form action="guardarEditComputer" method="post" class="my-4">
            {*<input name="id_computadora" type="hidden" value={$computadora->id_computadora} class="form-control">*}
            {foreach $datosComp item= computadora}
                <div class="form-group">
                    <label>Nombre de computadora</label>
                    <input name="nombre" type="text" value={strtoupper($computadora->nombre_comp)} class="form-control">
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <select name="marca">
                    {foreach from=$listaMarca item=marca}
                        <option value= {$marca->id_marca}>{$marca->nombre_marca}</option>
                    {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label>Sistema Operativo</label>
                    <input name="sistOpertivo" type="text" value={strtoupper($computadora->sistOperativo)} class="form-control">
                </div>
            {/foreach}
            {*<input name="marca" type="hidden" value={$computadora->id_marca} class="form-control">*}
            <button type="submit" class="btn btn-danger"><b>Guardar</b></button>
            <a class="btn btn-danger" href="listaComp"><b>Volver</b></a>
        </form>
        </div>

{include 'footer.tpl'}
