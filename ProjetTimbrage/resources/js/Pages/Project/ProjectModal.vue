  
  <template>
    <div v-bind:class="{'is-active': show}" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
            <p class="modal-card-title">{{title}}</p>
            <button @click="onCloseRequest" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
            <div class="block">
                <input v-model="editForm.name" class="input" type="text" placeholder="project name">
            </div>
            <div class="block">
                <input v-model="editForm.number" class="input" type="text" placeholder="project number">
            </div>
            </section>
            <footer class="modal-card-foot">
            <div class="card-footer-item">
                <div @click="onSave" class="box">
                    <figure class="image is-32x32">
                    <img src="/Icons/Save.png" alt="edit">
                    </figure>
                </div>
            </div>
            </footer>
        </div>
    </div>
</template>


<script>
  import JetNavLink from '@/Jetstream/NavLink'

  export default {
    props: {
        title : String,
        show : Boolean,
        name : String,
        number : String,
    },

    components:{
      JetNavLink
    },

    data() {
      return {
        editForm : ''
      }
    },

    created(){
        this.editForm = { name : this.name, number : this.number }
    },

    methods: {
      onSave(event) {
          this.$emit('newProjValues', {name : this.editForm.name, number : this.editForm.number})
      },

       onCloseRequest(event) {
          this.$emit('closeRequest')
      }
    },

    
  }

</script>
