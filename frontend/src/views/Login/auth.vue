<script setup>
import apiClient from "../../services/apiService";
import { ref, onMounted } from "vue";
import imgLogo from "../../../public/game.svg";
</script>

<template>
  <div class="mainAuth">
    <Splitter class="splitter-custom" layout="horizontal">
      <SplitterPanel
        class="flex align-items-center justify-content-center no-resize"
        :size="65"
      >
        <div>
          <img :src="imgLogo" alt="Logo" style="height: 700px" />
        </div>
      </SplitterPanel>
      <SplitterPanel
        class="flex align-items-center justify-content-center no-resize"
        :size="35"
      >
        <div class="formLogin">
          <div class="titleLogin">
            <label for="">Login</label>
          </div>
          <div class="username">
            <FloatLabel>
              <InputText class="inputUsername" v-model="value" />
              <label for="username">Username</label>
            </FloatLabel>
          </div>
          <div class="password">
            <FloatLabel>
              <InputText class="inputPassword" v-model="value" />
              <label for="password">Password</label>
            </FloatLabel>
          </div>
          <div class="button">
            <Button label="Login" style="width: 100%; height: 35px" />
          </div>
        </div>
      </SplitterPanel>
    </Splitter>
  </div>
</template>

<style>
.formLogin {
  width: 300px;
}
.formLogin .username,
.formLogin .password {
  margin-top: 25px;
  width: 100%;
}
.formLogin .username .inputUsername,
.formLogin .password .inputPassword {
  height: 45px;
  width: 100%;
}
.formLogin .button {
  margin-top: 25px;
}
.formLogin .titleLogin label {
  font-size: 25px;
  font-weight: bold;
  margin-left: auto;
  margin-right: auto;
}
.formLogin .titleLogin {
  display: flex;
  justify-content: center;
  align-items: center;
}
.splitter-custom {
  height: 95vh;
  border: none;
}
.splitter-custom .p-splitter-gutter {
  pointer-events: none;
  user-select: none;
}
.no-resize {
  flex-grow: 0 !important;
  flex-shrink: 0 !important;
}
</style>
