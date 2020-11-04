<template>
  <section class="chat-box">
    <div class="chat-box-list-container" ref="chatbox">
      <ul class="chat-box-list">
        <li 
          class="message"
          v-for="(message, idx) in messages"
          :key="idx"
          :class="message.author">
          <p>
            <span>
              {{ message.text }}
            </span>
          </p>
        </li>
      </ul>
    </div>
    <div class="chat-inputs">
      <input 
        type="text" 
        v-model="message" 
        @keyup.enter="sendMessage"
      />
      <button @click="sendMessage">Send</button>
    </div>
  </section>
</template>

<script>

export default {
  name: 'ChatBox',
  data: () => ({
    message: '',
    messages: [],
  }),
  mounted(){
  },
  methods: {
    sendMessage () {
      if(this.message != ''){
        this.messages.push({
          text: this.message,
          author: 'client'
        })

        this.$axios.get(`https://api-gce3.inbenta.io/prod/chatbot/v1/conversation/message=${this.message}`)
        .then(res => {
          this.messages.push({
            text: res.data.output,
            autor: 'server'
          })

          this.$nextTick(() => {
            this.$refs.chatbox.scrollTop = this.$refs.chatbox.scrollHeight
          })
        })

        this.message = ''
      }
    }
  }
}
</script>


<style scoped lang="scss">

  .chat-box,
  .chat-box-list{
    display: flex;
    flex-direction: column;
    list-style-type: none;
  }

  .chat-box-list{
    padding-left: 10px;
    padding-left: 0;
    span{
      padding: 8px;
      color: white;
      border-radius: 4px;
    }
    .server{
      span{
        background: green;
      }
      p{
        float: left;
      }
    }
    .client{
      span{
        background: blue;
      }
      p{
        float: right;
      }
    }

  }
    .chat-box-list-container{
    overflow: auto;
  }
  .chat-box{
    margin-top: 10px;
    border: 1px solid #999;
    width: 50vw;
    height: 60vh;
    border-radius: 4px;
    margin-left: auto;
    margin-right: auto;
    justify-content: space-between;
  }
  .chat-inputs{
    display: flex;
    input{
      line-height: 3;
      width: 100%;
      border: 1px solid #999;
      border-left: none;
      border-bottom: none;
      border-right: none;
      border-bottom-left-radius: 4px;
      padding-left: 15px;
    }
    button{
      width: 145px;
      color: white;
      background: #0070CB;
      border-bottom-right-radius: 4px;

    }
  }

</style>
