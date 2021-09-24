<template>
    <input 
        type="submit" 
        class="btn btn-danger mb-2 d-block w-100" 
        value="Eliminar x"
        v-on:click="eliminarReceta"
        >
</template>
<script>
    export default {
        props: ['recetaId'],
        /*mounted(){
            console.log('receta actual', this.recetaId)
        },
        methods: {
            eliminarReceta(){
                console.log('Le diste click en: ', this.recetaId);
            }
        }*/
        
        methods: {
            eliminarReceta(){
                this.$swal({
                    title: '¿Desea eliminar la receta?',
                    text: "Una vez iliminada, no se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!',
                    cancelButtonText: 'No!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const params = {
                            id: this.recetaId
                        }

                        //Enviar peticion al servidor
                        axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                            .then(respuesta => {
                                      this.$swal({
                                        title: 'Receta Eliminada',
                                        text: "Se elimino la receta",
                                        icon: 'success',
                                        });

                                        //ELIMINARMOS RECETA DEL DOM
                                        this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                                })
                            .catch(error => {
                                    console.log(error)
                                })                   
                        }
                })
        }
    }
    }
</script>
