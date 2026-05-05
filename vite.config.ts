import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// Match Create React App-style env names from the product spec.
export default defineConfig({
  plugins: [react()],
  envPrefix: ["REACT_APP_"],
});
