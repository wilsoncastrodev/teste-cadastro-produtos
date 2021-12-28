import { headers, getToken } from '../services/api';

const Products = {
  productsRelevant() {
    return axios.get(`/api/reports/`, headers(getToken()))
  },
}

export default Products;
