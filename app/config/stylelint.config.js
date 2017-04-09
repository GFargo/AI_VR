module.exports = {
  plugins: [
    'stylelint-order'
    ],
  rules: {
    'value-list-comma-space-after': 'always',
    'block-no-empty': true,
    'block-closing-brace-newline-after': 'always',
    'block-opening-brace-newline-after': 'always',
    'block-opening-brace-space-before': 'always',
    'color-no-invalid-hex': true,
    'declaration-no-important': true,
    'declaration-block-no-shorthand-property-overrides': true,
    'declaration-block-semicolon-newline-after': 'always',
    'declaration-colon-space-after': 'always',
    'font-family-name-quotes': 'always-unless-keyword',
    'font-weight-notation': 'numeric',
    'max-empty-lines': 1,
    'number-leading-zero': 'always',
    'order/declaration-block-properties-alphabetical-order' : true,
    'selector-max-specificity': '0,3,1',
    'selector-pseudo-element-colon-notation': 'double',
    'unit-no-unknown': true,
  },
};
