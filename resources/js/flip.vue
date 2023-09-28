<template>
  <div class="card shadow my-5" id="flip">
      <div class="card-header w-100">
          <h4
              class="card-title text-capitalize w-100 text-center text-dark text-uppercase"
          >
              {{ title }}
              <span class="badge bg-success rounded-pill ms-2">{{
                  sector
              }}</span>
              <!-- <span class="badge badge-warning rounded-pill ms-2">{{ email }}</span> -->

              <i v-if="type == `private`" class="fa fa-lock ml-auto"></i>
          </h4>
      </div>
      <div class="card-body">
          <Flipbook
              ref="flipbook"
              class="flipbook"
              :pages="pages"
              v-slot="flipbook"
              :zooms="null"
              @flip-right-start="onFlipRightStart"
          >
              <button @click="flipbook.flipLeft" class="btn-left">
                  <i class="fas fa-chevron-left"></i>
              </button>
              <button @click="flipbook.flipRight" class="btn-right">
                  <i class="fas fa-chevron-right"></i>
              </button>
              <!-- <p>{{ flipbook }}</p> -->
              <!-- <p @click="flipbook.page = 1">1</p>
              {{ flipbook.numPages }} -->
          </Flipbook>
          <div class="content">
              <div class="container">
                  <div class="row text-capitalize text-gray mx-5">
                      <p>{{ desc }}</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Flipbook from "flipbook-vue";
export default {
  props: ["flip", "route"],
  components: {
      Flipbook,
  },
  mounted() {
      var flipData = this.flip;
      var storage = "/storage/" + this.flip.name + "/";
      var dataImg = [null];
      if(this.flip.count != 1){
          for (let i = 0; i < Number(this.flip.count); i++) {
              dataImg.push(storage + this.flip.name + "-" + i + ".jpg");
          }
      }else{
          dataImg.push(storage + this.flip.name + ".jpg");
      }
      this.pages = dataImg;
      this.title = this.flip.title;
      this.sector = this.flip.sector;
      this.desc = this.flip.desc;
      this.type = this.flip.type;
      this.email = this.flip.email;
  },
  methods: {
      changePage() {
          this.$refs.flipbook.frontImage = this.$refs.flipbook.pageUrl(4);
          this.$refs.flipbook.backImge = this.$refs.flipbook.pageUrl(5);
          this.$refs.flipbook.firstPage = 4;
          this.$refs.flipbook.secondPage = 5;
          // this.$refs.flipbook.flipAuto(true);
      },
      onFlipRightStart(page) {
          console.log(page);
      },
  },
  data() {
      return {
          title: "",
          singlePage: false,
          pages: [],
          sector: "",
          desc: "",
          email: "",
          type: "",
          sosmed: [
              "Facebook",
              "Line",
              "LinkedIn",
              "Pinterest",
              "WhatsApp",
          ],
      };
  },
};
</script>

<style>
i.fa-lock {
  position: absolute;
  right: 15px;
  top: 15px;
  cursor: pointer;
  color: #a2a2a2;
}
.sosmed:nth-child(1) i {
  color: blue;
}
.sosmed:nth-child(2) i{
  color: rgb(2, 219, 38);
}
.sosmed:nth-child(3) i{
  color: rgb(0, 140, 255);
}
.sosmed:nth-child(4) i{
  color: rgb(210, 5, 9);
}
.sosmed:nth-child(5) i{
  color: rgb(0, 141, 16);
}
.sosmed:nth-child(6) i{
  color: rgb(255, 54, 104);
}
.share-btn {
  font-size: 24px;
  padding: 13px;
  border: 1px solid #a2a2a2;
  border-radius: 50%;
  transition: 0.5s;
}
.share-btn:hover {
  background-color: gray;
}

html,
body {
  margin: 0;
  padding: 0;
}
#flip {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /* max-height: 90vh; */
  width: 100%;
  display: flex;
  overflow: hidden;
  flex-direction: column;
  align-items: center;
  /* background-color: #333; */
  color: #ccc;
}
a {
  color: inherit;
}
.flipbook > button:first-child {
  position: absolute;
  top: 50%;
  left: 10px;
  border-radius: 50%;
  z-index: 1;
  padding: 8px 15px;
}
.flipbook > button:nth-child(2) {
  position: absolute;
  top: 50%;
  right: 10px;
  border-radius: 50%;
  padding: 8px 15px;
  z-index: 1;
}
.action-bar {
  width: 100%;
  height: 50px;
  padding: 10px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
.action-bar .btn {
  font-size: 30px;
  color: #999;
}
.action-bar .btn svg {
  bottom: 0;
}
.action-bar .btn:not(:first-child) {
  margin-left: 10px;
}
.has-mouse .action-bar .btn:hover {
  color: #ccc;
  filter: drop-shadow(1px 1px 5px #000);
  cursor: pointer;
}
.action-bar .btn:active {
  filter: none !important;
}
.btn-left.disabled {
  color: #666;
  pointer-events: none;
}
.btn-right.disabled {
  color: #666;
  pointer-events: none;
}
.action-bar .page-num {
  font-size: 12px;
  margin-left: 10px;
}
.card-body .flipbook .viewport {
  width: 80vw;
  height: calc(100vh - 50px - 40px);
}
.card-body .flipbook .bounding-box {
  box-shadow: 0 0 20px #000;
}
.credit {
  font-size: 12px;
  line-height: 20px;
  margin: 10px;
}
.card-body {
  color: #6e6e6e;
  font-weight: 600;
}
.card-title {
  font-weight: 900;
}
</style>
