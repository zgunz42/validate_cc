import axios from 'axios';

let token = document.head.querySelector('meta[name="csrf-token"]');

const client = axios.create({
  baseURL: `${window.location.origin}/api/v1/`,
  headers: {'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token.content}
});

export default client;
