<template>
  <div id="nodeToRenderAsPDF">
  <table>

    <tr>
     <td style="color: red; font-size:17px;">heeeeyyyyy</td>
     <td>heeeeyyyyy</td>
     <td>heeeeyyyyy</td>
     <td>heeeeyyyyy</td>
     <td>heeeeyyyyy</td>
    </tr>
  </table>
  <button @click="take()"> take </button>
  </div>
</template>

</div>

<script>
export default {
  methods: {
    take: function() {
      const options = {
        format: "A4",
        footer: {
          height: "10mm",
          contents: {
            default:
              '<div style=" position: absolute; right: 0"><span style="color: #444;">{{page}}</span>/<span>{{pages}}</span></div>'
          }
        },
        border: {
          left: "2cm",
          right: "1cm",
          top: "0.5cm",
          bottom: "0.2cm"
        },
        base: "file:///D:/css"
      };

      const school = "Goverment Technical High School Bamenda";
      let fileName = `test.pdf` || "file.pdf";
      let compiled = pug.compileFile("./template/test.pug", { pretty: true });
      const d = new Date(date).toDateString();
      const html = compiled({
        quote,
        duration,
        QUESTIONS,
        sequence,
        parser,
        d,
        teacher,
        classRoom,
        school
      });
      // fs.writeFileSync('./toale.html', html)
      pdf.create(html, options).toFile(fileName, function(err, resl) {
        if (err) console.log(err);
        res.sendFile(fileName);
      });
    }
  }
};
</script>
