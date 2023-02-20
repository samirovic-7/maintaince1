<template>
  <button @click="exportExecl1" class="btn btn-primary" style="margin: 5%">export 1</button>
  <button @click="exportExecl2"  class="btn btn-danger">export 2</button>
  <br><br>
  <button @click="Downpdf" class="btn btn-warning">pdf 1</button> <button @click="Downpdf" class="btn btn-warning">pdf 1</button>
</template>

<script>
import xlsx from "xlsx/dist/xlsx.full.min"
import pdfMake from "pdfmake/build/pdfmake"
import pdfFonts from "pdfmake/build/vfs_fonts"

pdfMake.vfs = pdfFonts.pdfMake.vfs

export default {
  // eslint-disable-next-line vue/component-api-style
  data(){
    return{
      framework1:[
        ["A1", "B1", "C1"],
        ["A2", "B2", "C2"],
        ["A3", "B3", "C3"],
      ],
      framework2:[
        { name:"mohamed" , birthday:"15/04" },
        { name:"samir" , birthday:"8/10" },
        { name:"ahmed" , birthday:"10/08" },
      ],
    }
  },

  // eslint-disable-next-line vue/component-api-style
  methods:{
    exportExecl1(){
      const XLSX = xlsx
      const workbook = XLSX.utils.book_new()
      const worksheet = XLSX.utils.aoa_to_sheet(this.framework1)

      XLSX.utils.book_append_sheet(workbook, worksheet, "framework1")
      XLSX.writeFile(workbook,"framework1.xlsx")
    },

    exportExecl2(){
      const XLSX = xlsx
      const workbook = XLSX.utils.book_new()
      const worksheet = XLSX.utils.json_to_sheet(this.framework2)

      XLSX.utils.book_append_sheet(workbook, worksheet, "framework2")
      XLSX.writeFile(workbook,"framework2.xlsx")
    },
    Downpdf(){
      let docDefinition = {
        content: [
          {
            layout: 'lightHorizontalLines',
            table: {
              headerRows: 1,
              widths: [ '*', 50,200,"*"],

              body:  this.framework1,

            },
          },
        ],
      }
      pdfMake.createPdf(docDefinition).open()
      // pdfMake.createPdf(docDefinition).download()
      // pdfMake.createPdf(docDefinition).print()

    },
  },
}
</script>
