export default defineAppConfig({
  ui: {
    colors: {
      primary: 'ultramarine',
      neutral: 'ink'
    },
    footer: {
      slots: {
        container: 'flex flex-col-reverse lg:flex-row py-8 lg:py-4 lg:flex lg:items-center lg:justify-between lg:gap-x-3',
      }
    }
  }
})
