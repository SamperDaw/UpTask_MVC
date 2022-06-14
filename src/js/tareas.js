(function () {
    //Boton para mostrar modal de agregar tareas
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);


    function mostrarFormulario() {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
            <legend>Añade una nueva tarea</legend>
            <div class="campo">
                <label>Tarea</label>
                <input 
                    type="text"
                    name="tarea"
                    placeholder="Añadir tarea al proyecto actual"
                    id="tarea"
                />                
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nueva-tarea" value="Añadir tarea"/>
                <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
            </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 0);

        modal.addEventListener('click', function (e) {
            e.preventDefault();

            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 500);
            }

            if (e.target.classList.contains('submit-nueva-tarea')) {
                submitFormularioNuevaTarea();
            }
        })

        document.querySelector('.dashboard').appendChild(modal);
    }

        function submitFormularioNuevaTarea() {
            const tarea = document.querySelector('#tarea').value.trim();

            if (tarea === '') {
                //Mostrar alerta de error
                mostrarAlerta('El nombre de la tarea es obligatorio', 'error',
                    document.querySelector('.formulario legend'));
                return;
            }
            agregarTarea(tarea);

        }


        //Muestra mensaje en interfaz
        function mostrarAlerta(mensaje, tipo, referencia) {
            //previene varias aleretas
            const prevenirAlerta = document.querySelector('.alerta');
            if(prevenirAlerta){
                prevenirAlerta.remove();
            }
            const alerta = document.createElement('DIV');
            alerta.classList.add('alerta', tipo);
            alerta.textContent = mensaje;
            //inserta la alerta antes del legend
            referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

            //eliminar la alerta
            setTimeout(() => {
                alerta.remove();
            }, 5000);

        }

        //consultar servidor para añadir una tarea
        function agregarTarea(tarea){
            //construir peticion
            const datos = new FormData();
            datos.append('nombre','Alberto');

            try {
                
            } catch (error) {
                console.log(error);
                
            }
        }
        

})();