<template>
  <div class="card">
    <Menubar :model="items" class="custom-menubar">

      <template #start></template>
      <template #end>
        <div class="flex align-items-center gap-2">
          <div class="toggle-container" @click="toggleDarkMode">
            <Button class="toggle-button">
              <i :class="checked ? 'pi pi-moon' : 'pi pi-sun'" :style="{ color: checked ? 'yellow' : 'orange' }"></i>
            </Button>
          </div>
          <InputText placeholder="Search" type="text" style="width: 200px;"   />
          <div class="dropdown-container">
            <Button class="custom-split-button" @click="toggleDropdown">
              <img :src="getImage()" alt="Role Icon" class="button-image" />
            </Button>
            <div v-if="isDropdownVisible" class="dropdown-menu">
              <ul>
                <li @click="handleAction('profile')">Profile</li>
                <li @click="handleAction('setting')">Setting</li>
                <li @click="handleAction('auth')">Login</li>
              </ul>
            </div>
          </div>
        </div>
      </template>
    </Menubar>
  </div>
</template>

<script lang="ts" setup>
import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import spongebobImg from "../assets/sepongebob.png";

const router = useRouter();

const checked = ref(localStorage.getItem('dark-mode') === 'true');
const role = "director";
const isDropdownVisible = ref(false);

function toggleDropdown() {
  isDropdownVisible.value = !isDropdownVisible.value;
}

function handleAction(action:any) {
  if (action === "auth" || action === "profile" || action === "settings") {
    router.push({ name: action });
  } else {
    console.error(`Route "${action}" tidak ditemukan!`);
  }
  isDropdownVisible.value = false;
}



function getImage() {
  if (role === "director") {
    return spongebobImg;
  }
}

const items = ref([
  {
    label: "Home",
    icon: "pi pi-home",
  },
  {
    label: "Features",
    icon: "pi pi-star",
  },
  {
    label: "Projects",
    icon: "pi pi-search",
    items: [
      {
        label: "Core",
        icon: "pi pi-bolt",
        shortcut: "⌘+S",
      },
      {
        label: "Blocks",
        icon: "pi pi-server",
        shortcut: "⌘+B",
      },
      {
        label: "UI Kit",
        icon: "pi pi-pencil",
        shortcut: "⌘+U",
      },
      {
        separator: true,
      },
      {
        label: "Templates",
        icon: "pi pi-palette",
        items: [
          {
            label: "Apollo",
            icon: "pi pi-palette",
            badge: 2,
          },
          {
            label: "Ultima",
            icon: "pi pi-palette",
            badge: 3,
          },
        ],
      },
    ],
  },
  {
    label: "Contact",
    icon: "pi pi-envelope",
    badge: 3,
  },
]);

function switchTheme(theme: string) {
  const existingLink = document.getElementById('theme-link');
  if (existingLink) {
    existingLink.remove();
  }
  const themeLink = document.createElement('link');
  themeLink.id = 'theme-link';
  themeLink.rel = 'stylesheet';
  themeLink.href = `/node_modules/primevue/resources/themes/${theme}/theme.css`; // Sesuaikan dengan path tema yang benar
  document.head.appendChild(themeLink);
}

function toggleDarkMode() {
  checked.value = !checked.value;
  if (checked.value) {
    switchTheme('aura-dark-lime'); 
    localStorage.setItem('dark-mode', 'true');
  } else {
    switchTheme('saga-blue'); 
    localStorage.setItem('dark-mode', 'false');
  }
}

function applyInitialTheme() {
  if (checked.value) {
    switchTheme('aura-dark-lime'); 
  } else {
    switchTheme('saga-blue');
  }
}
watch(checked, (newValue) => {
  const htmlElement = document.documentElement;
  if (newValue) {
    htmlElement.classList.add("dark");
    htmlElement.classList.remove("light");
  } else {
    htmlElement.classList.add("light");
    htmlElement.classList.remove("dark");
  }
});

applyInitialTheme();
</script>

<style scoped>
.custom-menubar {
  padding-left: 4rem;
}

.p-menubar .p-menuitem:first-child .p-menuitem-text {
  padding-left: 1rem;
}

.p-menubar .p-menuitem:nth-child(2) .p-menuitem-text {
  padding-left: 1.5rem;
}

.p-menubar .p-menuitem:nth-child(3) .p-menuitem-text {
  padding-left: 1.5rem;
}

.dropdown-container {
  position: relative;
}

.custom-split-button {
  padding: 0px;
  border-radius: 50%;
  margin: 10px;
  background-color: transparent;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.button-image {
  width: 50px;
  height: auto;
  border-radius: 50%;
}

.dropdown-container {
  position: relative;
  display: inline-block;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  width: 150px;
  left: -80px;
  background: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

.dropdown-menu ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.dropdown-menu li {
  padding: 8px 16px;
  cursor: pointer;
  color: black;
  font-weight: bold;
}

.dropdown-menu li:hover {
  background-color: #f0f0f0;
}

.toggle-container {
  display: flex;
  align-items: center;
  justify-content: center;
}

.toggle-button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  font-size: 1.5rem;
}
</style>

<style>
html.light {
  --bg-color: white;
  --text-color: black;
}

html.dark {
  --bg-color: #1a1a1a;
  --text-color: white;
}

body {
  background-color: var(--bg-color);
  color: var(--text-color);
  transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
