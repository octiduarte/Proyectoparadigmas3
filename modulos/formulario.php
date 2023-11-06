<form class="row g-3">
    <div class="col-md-6">
        <label for="inputNombre4" class="form-label">Nombre</label>
        <input type="nombre" class="form-control" id="inputNombre4" />
    </div>
    <div class="col-md-6">
        <label for="inputApellido4" class="form-label">Apellido</label>
        <input type="apellido" class="form-control" id="inputApellido4" />
    </div>
    <div class="col-12">
        <label for="inputEmail" class="form-label">Email</label>
        <input type="text" class="form-control" id="inputEmail" placeholder="hola@gmail.com" />
    </div>
    <div class="col-12">
        <label for="inputAddress" class="form-label">Direccion</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="Vicente casares 1250" />
    </div>
    <div class="col-md-6">
        <label for="inputCity" class="form-label">Ciudad</label>
        <input type="text" class="form-control" id="inputCity" />
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Pais</label>
        <select id="inputState" class="form-select">
            <option selected>Elegir...</option>
            <option>Argentina</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="inputZip" class="form-label">Codigo Postal</label>
        <input type="text" class="form-control" id="inputZip" />
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" />
            <label class="form-check-label" for="gridCheck"> Guardar datos </label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-dark">Confirmar</button>
    </div>
</form>