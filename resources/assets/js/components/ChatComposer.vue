<template lang="html">
	<div class="chat-composer">
		<input id="message" type="text" name="" placeholder="Start typing your message.." v-model="messageText" @keyup.enter="sendMessage">
		<button class="btn btn-primary" @click="sendMessage">Send</button>
	</div>
</template>

<script>
	export default {
		data(){
			return{
				messageText:''
			}
		},
		methods: {
			sendMessage(){
				//$emitはイベントを発生させる(イベント名は'messagesent')
				this.$emit("messagesent",{
					message: this.messageText,
					user: {
						name:$("#app-navbar-collapse > ul.nav.navbar-nav.navbar-right > li > a").text()
					},
					roomId: $(".room_id").text()
				});
				this.messageText = '';//input内を空に
			}
		}
	}
</script>

<style lang="css">
	.chat-composer {
		display: flex;
	}
	.chat-composer input {
		flex: 1 auto;
	}
	.chat-composer button {
		border-radius: 0;
	}

</style>