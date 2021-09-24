<template>
     <span>{{ formatearFecha }}</span>
</template>

<script>
     import moment from 'moment';

    export default {
        props: ['fecha'],
        /*mounted(){
            console.log('La fecha es ',this.fecha);
        },*/
        computed: {
            formatearFecha(){
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
            }
        }

    }
</script>
