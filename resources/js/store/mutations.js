export default {
    page_loader(state, payload) {
        state.page_loader = payload
    },
    loading(state, payload) {
        state.loading = payload
    },
    errors(state, payload) {
        state.errors = payload
    },
    alertEvent(state, payload) {
        state.alertEvent = payload
    },

    updateAgents(state, payload) {
        state.agents = payload
    },

    updateProducts(state, payload) {
        state.products = payload
    },

    updateVendors(state, payload) {
        state.vendors = payload
    },
    updateStock(state, payload) {
        state.stock = payload
    },
    updateOpeningStock(state, payload) {
        state.opening_stock = payload
    },

}

