!function(){!async function(){try{const a="/api/tareas?id="+r(),n=await fetch(a),o=await n.json();e=o.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay Tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const n={0:"Pendiente",1:"Completa"};e.forEach(c=>{const s=document.createElement("LI");s.dataset.tareaId=c.id,s.classList.add("tarea");const d=document.createElement("P");d.textContent=c.nombre,d.ondblclick=function(){a(editar=!0,{...c})};const i=document.createElement("DIV");i.classList.add("opciones");const l=document.createElement("BUTTON");l.classList.add("estado-tarea"),l.classList.add(""+n[c.estado].toLowerCase()),l.textContent=n[c.estado],l.dataset.btnEstadoTarea=c.estado,l.ondblclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,o(e)}({...c})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=c.id,m.textContent="Eliminar",m.ondblclick=function(){!function(a){Swal.fire({title:"¿Seguro que desea eliminar esta tarea?",showCancelButton:!0,confirmButtonText:"Si",cancelButtonText:"No"}).then(n=>{n.isConfirmed&&async function(a){const{estado:n,id:o,nombre:c}=a,s=new FormData;s.append("id",o),s.append("nombre",c),s.append("estado",n),s.append("proyectoId",r());try{const n="http://localhost:3000/api/tarea/eliminar",o=await fetch(n,{method:"POST",body:s}),r=await o.json();r.resultado&&(Swal.fire("Eliminado!",r.mensaje,"success"),e=e.filter(e=>e.id!==a.id),t())}catch(e){}}(a)})}({...c})},i.appendChild(l),i.appendChild(m),s.appendChild(d),s.appendChild(i);document.querySelector("#listado-tareas").appendChild(s)})}function a(a=!1,c={}){const s=document.createElement("DIV");s.classList.add("modal"),s.innerHTML=`\n            <form class="formulario nueva-tarea">\n            <legend>${a?"Editar Tarea":"Añade una nueva tarea"}</legend>\n            <div class="campo">\n                <label>Tarea</label>\n                <input \n                    type="text"\n                    name="tarea"\n                    placeholder="${c.nombre?"Editar la tarea":"Añadir tarea al proyecto actual"}"\n                    id="tarea"\n                    value="${c.nombre?c.nombre:""}"\n                />                \n            </div>\n            <div class="opciones">\n                <input \n                    type="submit" \n                    class="submit-nueva-tarea" \n                    value="${c.nombre?"Guardar Cambios":"Añadir Tarea"}"\n                    />\n                <button \n                    type="button" \n                    class="cerrar-modal">Cancelar\n                </button>\n            </div>\n            </form>\n        `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),s.addEventListener("click",(function(d){if(d.preventDefault(),d.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{s.remove()},500)}if(d.target.classList.contains("submit-nueva-tarea")){const s=document.querySelector("#tarea").value.trim();if(""===s)return void n("El nombre de la tarea es obligatorio","error",document.querySelector(".formulario legend"));a?(c.nombre=s,o(c)):async function(a){const o=new FormData;o.append("nombre",a),o.append("proyectoId",r());try{const r="http://localhost:3000/api/tarea",c=await fetch(r,{method:"POST",body:o}),s=await c.json();if(n(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const n=document.querySelector(".modal");setTimeout(()=>{n.remove()},3e3);const o={id:String(s.id),nombre:a,estado:"0",proyectoId:s.proyectoId};e=[...e,o],t()}}catch(e){console.log(e)}}(s)}})),document.querySelector(".dashboard").appendChild(s)}function n(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}async function o(a){const{estado:n,id:o,nombre:c,proyectoId:s}=a,d=new FormData;d.append("id",o),d.append("nombre",c),d.append("estado",n),d.append("proyectoId",r());try{const a="http://localhost:3000/api/tarea/actualizar",r=await fetch(a,{method:"POST",body:d}),s=await r.json();if("exito"===s.respuesta.tipo){Swal.fire(s.respuesta.mensaje,s.respuesta.mensaje,"success");const a=document.querySelector(".modal");a&&a.remove(),e=e.map(e=>(e.id===o&&(e.estado=n,e.nombre=c),e)),t()}}catch(e){console.log(e)}}function r(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){a()}))}();