<script>
const API_KEY = 'http://127.0.0.1:8000/api/qusote'

export default {
  mounted() {
    this.requestNewQuote()
  },
  data() {
    return {
      quoteObj: {
        text: '#',
        author: '#',
        date: '1000-01-01'
      }
    }
  },
  methods: {
    async requestNewQuote() {
      const response = await fetch(API_KEY, {
        method: 'GET',
        headers: {
          Accept: 'application/json'
        }
      })

      if (response.ok) {
        const requestedQuote = await response.json()
        this.quoteObj = requestedQuote.quote
      } else {
        this.quoteObj = undefined
      }
    }
  }
}
</script>

<template>
  <div class="quote">
    <div class="container">
      <div class="quote__inner" v-if="quoteObj">
        <div class="quote__text">"{{ quoteObj.text }}"</div>
        <div class="quote__author">&#169; {{ quoteObj.author }}</div>
        <div class="quote__date">{{ new Date(quoteObj.date).toLocaleDateString() }}</div>
      </div>
      <div class="quote__error" v-else>
        Looks like Unknown Team server is unavailable... Try again later.
      </div>
      <button class="new-quote-button" @click="requestNewQuote">Новая цитата</button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@import '@/assets/scss/variables.scss';

.quote {
  margin: 15px;

  font-family: $mainAppFontFamily;
  font-size: $quoteFontSize;

  color: $mainAppColor;
}

.quote__inner {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 25px;

  text-align: center;
  word-break: break-word;

  border: 2px solid $mainAppColor;
  border-radius: $appBlockBorderRadius;
}

.quote__author {
  margin: 20px 0 25px 0;
  width: fit-content;

  font-size: $authorFontSize;

  color: $secondAppColor;
  border-bottom: 1px solid $secondAppColor;
}

.quote__date {
  align-self: flex-end;

  font-size: $dateFontSize;
  text-align: right;
}

.new-quote-button {
  float: right;

  margin: 15px 0;
  padding: 10px;

  font-family: $mainAppFontFamily;
  font-size: 16px;
  font-weight: bold;
  text-transform: uppercase;

  color: $mainAppColor;
  background-color: transparent;
  border: 2px solid $mainAppColor;
  border-radius: $appBlockBorderRadius;

  transition-property: color, background-color;
  transition-duration: 0.35s;

  cursor: pointer;
}

@media (hover) {
  .new-quote-button:hover {
    color: $backgroundAppColor;
    background-color: $mainAppColor;
  }
}
</style>
