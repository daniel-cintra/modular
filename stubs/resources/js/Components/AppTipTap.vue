<template>
  <div>
    <div
      class="mx-0 mb-0 flex flex-none flex-wrap items-center break-words border-x border-t border-solid border-skin-base-300 bg-no-repeat p-2 font-sans text-xl leading-5 tracking-normal text-stone-500"
      :class="editorClass"
    >
      <TipTapButton
        title="Negrito"
        icon="ri-bold"
        @click.prevent="editor.commands.toggleBold()"
      />

      <TipTapButton
        title="Itálico"
        icon="ri-italic"
        @click.prevent="editor.commands.toggleItalic()"
      />

      <TipTapButton
        title="Sublinhado"
        icon="ri-underline"
        @click.prevent="editor.commands.toggleUnderline()"
      />

      <TipTapButton
        title="Strike"
        icon="ri-strikethrough"
        @click.prevent="editor.commands.toggleStrike()"
      />

      <TipTapDivider />

      <TipTapButton
        title="H1"
        icon="ri-h-1"
        @click.prevent="editor.commands.toggleHeading({ level: 1 })"
      />

      <TipTapButton
        title="H2"
        icon="ri-h-2"
        @click.prevent="editor.commands.toggleHeading({ level: 2 })"
      />

      <TipTapButton
        title="H3"
        icon="ri-h-3"
        @click.prevent="editor.commands.toggleHeading({ level: 3 })"
      />

      <TipTapButton
        title="H4"
        icon="ri-h-4"
        @click.prevent="editor.commands.toggleHeading({ level: 4 })"
      />

      <TipTapButton
        title="Parágrafo"
        icon="ri-paragraph"
        @click.prevent="editor.commands.setParagraph()"
      />

      <TipTapButton
        title="Lista"
        icon="ri-list-unordered"
        @click.prevent="editor.commands.toggleBulletList()"
      />

      <TipTapButton
        title="Lista Ordenada"
        icon="ri-list-ordered"
        @click.prevent="editor.commands.toggleOrderedList()"
      />

      <TipTapButton
        title="Adicionar Link"
        icon="ri-link-m"
        @click.prevent="setLink"
      />

      <TipTapButton
        title="Remover Link"
        icon="ri-link-unlink-m"
        @click.prevent="editor.commands.unsetLink()"
      />

      <TipTapDivider />

      <TipTapButton
        title="Quebra de Linha"
        icon="ri-text-wrap"
        @click.prevent="editor.commands.setHardBreak()"
      />

      <TipTapButton
        title="Linha Horizontal"
        icon="ri-separator"
        @click.prevent="editor.commands.setHorizontalRule()"
      />

      <TipTapButton
        title="Limpa Formatação"
        icon="ri-format-clear"
        @click.prevent="editor.commands.clearNodes()"
      />

      <TipTapDivider />

      <TipTapButton
        title="YouTube Vídeo"
        icon="ri-youtube-line"
        @click.prevent="addVideo"
      />

      <TipTapDivider />

      <TipTapButton
        title="Tabela"
        icon="ri-table-line"
        @click.prevent="toggleTableToolbar"
      />

      <TipTapDivider />

      <TipTapButton
        title="Desfazer"
        icon="ri-arrow-go-back-line"
        @click.prevent="editor.commands.undo()"
      />

      <TipTapButton
        title="Refazer"
        icon="ri-arrow-go-forward-line"
        @click.prevent="editor.commands.redo()"
      />
    </div>

    <div
      v-show="showTableToolbar"
      class="mx-0 mb-0 flex flex-none flex-wrap items-center break-words border-x border-t border-solid border-skin-base-300 border-t-skin-base-200 bg-no-repeat p-2 font-sans text-xl leading-5 tracking-normal text-stone-500"
    >
      <TipTapButton
        title="Inserir Tabela"
        icon="ri-table-2"
        @click.prevent="
          editor.commands.insertTable({
            rows: 3,
            cols: 3,
            withHeaderRow: true
          })
        "
      />

      <TipTapDivider />

      <TipTapButton
        title="Adicionar coluna antes"
        icon="ri-layout-3-line"
        @click.prevent="editor.commands.addColumnBefore()"
      />

      <TipTapButton
        title="Adicionar coluna depois"
        icon="ri-layout-6-line"
        @click.prevent="editor.commands.addColumnAfter()"
      />

      <TipTapButton
        title="Deletar coluna"
        icon="ri-delete-column"
        @click.prevent="editor.commands.deleteColumn()"
      />

      <TipTapDivider />

      <TipTapButton
        title="Adicionar linha antes"
        icon="ri-insert-row-top"
        @click.prevent="editor.commands.addRowBefore()"
      />

      <TipTapButton
        title="Adicionar linha depois"
        icon="ri-insert-row-bottom"
        @click.prevent="editor.commands.addRowAfter()"
      />

      <TipTapButton
        title="Deletar linha"
        icon="ri-delete-row"
        @click.prevent="editor.commands.deleteRow()"
      />

      <TipTapDivider />

      <TipTapButton
        title="Mesclar Células"
        icon="ri-merge-cells-horizontal"
        @click.prevent="editor.commands.mergeCells()"
      />

      <TipTapButton
        title="Dividir Células"
        icon="ri-split-cells-horizontal"
        @click.prevent="editor.commands.splitCell()"
      />

      <TipTapButton
        title="Alternar Coluna Cabeçalho"
        icon="ri-archive-drawer-line"
        @click.prevent="editor.commands.toggleHeaderColumn()"
      />

      <TipTapButton
        title="Alternar Linha Cabeçalho"
        icon="ri-archive-drawer-fill"
        @click.prevent="editor.commands.toggleHeaderRow()"
      />

      <TipTapButton
        title="Alternar Cabeçalho Célula"
        icon="ri-split-cells-vertical"
        @click.prevent="editor.commands.toggleHeaderCell()"
      />

      <TipTapButton
        title="Mesclar ou Dividir"
        icon="ri-merge-cells-vertical"
        @click.prevent="editor.commands.mergeOrSplit()"
      />

      <!-- <TipTapButton
          title="Definir Atributo da Célula"
          icon="ri-information-line"
          @click.prevent=""
        /> -->

      <TipTapDivider />

      <TipTapButton
        title="Ir Próxima Célula"
        icon="ri-arrow-right-s-line"
        @click.prevent="editor.chain().focus().goToNextCell().run()"
      />

      <TipTapButton
        title="Ir Célula Anterior"
        icon="ri-arrow-left-s-line"
        @click.prevent="editor.chain().focus().goToPreviousCell().run()"
      />

      <TipTapDivider />

      <TipTapButton
        title="Consertar Tabelas"
        icon="ri-settings-line"
        @click.prevent="editor.commands.fixTables()"
      />

      <TipTapButton
        title="Deletar tabela"
        icon="ri-delete-bin-2-line"
        @click.prevent="editor.commands.deleteTable()"
      />
    </div>
    <editor-content
      :editor="editor"
      class="relative m-0 max-h-[240px] min-h-[120px] overflow-auto break-words border border-solid border-skin-base-300 bg-no-repeat py-1 px-1 font-sans text-xs leading-5 tracking-normal text-skin-base-content"
    />
  </div>
</template>

<script setup>
import { ref, onBeforeUnmount } from 'vue'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import Link from '@tiptap/extension-link'
import Youtube from '@tiptap/extension-youtube'
import Table from '@tiptap/extension-table'
import TableCell from '@tiptap/extension-table-cell'
import TableHeader from '@tiptap/extension-table-header'
import TableRow from '@tiptap/extension-table-row'
import TipTapButton from './TipTap/TipTapButton.vue'
import TipTapDivider from './TipTap/TipTapDivider.vue'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  editorClass: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const showTableToolbar = ref(false)

const editor = useEditor({
  content: props.modelValue,
  extensions: [
    StarterKit,
    Underline,
    Link.configure({
      openOnClick: false
    }),
    Youtube.configure({
      controls: false
    }),
    Table.configure({
      resizable: true
    }),
    TableRow,
    TableHeader,
    TableCell
  ],
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML())
  }
})

onBeforeUnmount(() => {
  editor.value.destroy()
})

const toggleTableToolbar = () => {
  showTableToolbar.value = !showTableToolbar.value
}

const setLink = () => {
  // console.log(editor.value.getAttributes('link').href)
  const previousUrl = editor.value.getAttributes('link').href
  const url = window.prompt('URL', previousUrl)
  // cancelled
  if (url === null) {
    return
  }
  // empty
  if (url === '') {
    editor.value.chain().focus().extendMarkRange('link').unsetLink().run()
    return
  }
  // update link
  editor.value
    .chain()
    .focus()
    .extendMarkRange('link')
    .setLink({ href: url })
    .run()
}

const addVideo = () => {
  const url = prompt('Enter YouTube URL')

  if (!url) {
    return
  }

  editor.value.commands.setYoutubeVideo({
    src: url,
    width: 640,
    height: 480
  })
}
</script>

<style>
.app-tip-tap-error {
  border: 1px solid red;
  border-radius: 3px;
}

.ProseMirror {
  min-height: 120px;
  padding: 5px 10px;
}

.ProseMirror p {
  margin: 1em 0;
}

.ProseMirror a {
  text-decoration: underline;
  color: blue;
}

/* Heading Sizes, See: https://tailwindcss.com/docs/font-size */

.ProseMirror h1 {
  font-size: 2.25rem; /* 36px */
  line-height: 2.5rem; /* 40px */
}

.ProseMirror h2 {
  font-size: 1.875rem; /* 30px */
  line-height: 2.25rem; /* 36px */
}

.ProseMirror h3 {
  font-size: 1.5rem; /* 24px */
  line-height: 2rem; /* 32px */
}

.ProseMirror h4 {
  font-size: 1.25rem; /* 20px */
  line-height: 1.75rem; /* 28px */
}

.ProseMirror ul {
  display: block;
  list-style-type: disc;
  padding-left: 0.8rem;
}

.ProseMirror ul li {
  display: list-item;
}

.ProseMirror ol {
  display: block;
  list-style: decimal;
  padding-left: 0.8rem;
}

.ProseMirror table {
  border-collapse: collapse;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  overflow: hidden;
}

.ProseMirror table td,
.ProseMirror table th {
  min-width: 1em;
  border: 2px solid #ced4da;
  padding: 3px 5px;
  vertical-align: top;
  box-sizing: border-box;
  position: relative;
}

.ProseMirror table th > * {
  margin-bottom: 0;
}

.ProseMirror th {
  font-weight: bold;
  text-align: left;
  background-color: #f1f3f5;
}

.ProseMirror .selectedCell:after {
  z-index: 2;
  position: absolute;
  content: '';
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  background: rgba(200, 200, 255, 0.4);
  pointer-events: none;
}

.ProseMirror .column-resize-handle {
  position: absolute;
  right: -2px;
  top: 0;
  bottom: -2px;
  width: 4px;
  background-color: #adf;
  pointer-events: none;
}

.ProseMirror p {
  margin: 0;
}

.tableWrapper {
  padding: 1rem 0;
  overflow-x: auto;
}

.resize-cursor {
  cursor: ew-resize;
  cursor: col-resize;
}
</style>
