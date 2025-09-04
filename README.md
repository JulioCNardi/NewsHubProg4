# NewsHubProg4
Beleza 👌 Vou te mostrar como configurar o **Yii2 template básico** quando você baixa o **zip** direto do site (sem usar o Composer).

---

## 🚀 Passo a passo da instalação

### 1. Baixar o Yii2 Basic

* Vá até [https://www.yiiframework.com/download](https://www.yiiframework.com/download)
* Baixe o **Basic Project Template** (`yii-basic-app-*.zip`)

Descompacte o arquivo em uma pasta do seu servidor local, por exemplo:

```
C:\laragon\www\meu_projeto
```

ou

```
C:\xampp\htdocs\meu_projeto
```

---

### 2. Estrutura de pastas

Depois de extrair, você deve ter algo assim:

```
meu_projeto/
 ├─ assets/
 ├─ commands/
 ├─ config/
 ├─ controllers/
 ├─ models/
 ├─ runtime/
 ├─ vendor/   (pode estar vazio se for instalação por zip)
 ├─ views/
 ├─ web/
 ├─ yii
 └─ composer.json
```

⚠️ Se a pasta `vendor/` estiver **vazia**, o Yii2 não vai rodar ainda — porque ela contém as dependências.

---

### 3. Baixar as dependências (sem composer)

Como você não está usando `composer install`, precisa baixar o **vendor.zip** manualmente:

* Entre no GitHub do Yii2 basic:
  👉 [https://github.com/yiisoft/yii2-app-basic](https://github.com/yiisoft/yii2-app-basic)
* Procure pela release correspondente e baixe o **vendor.zip** (ou pegue o pacote completo já com vendor).
* Extraia dentro da pasta `meu_projeto/vendor`.

---

### 4. Configurar o host local

Se estiver usando **Laragon**, basta colocar a pasta dentro do `www` que ele cria o virtual host automaticamente:

```
http://meu_projeto.test
```

Se for **XAMPP/WAMP**, acesse direto pelo navegador:

```
http://localhost/meu_projeto/web/
```

> Sempre acessar pelo `/web/`, porque é a raiz pública do Yii2.

---

### 5. Criar a chave `cookieValidationKey`

No arquivo:

```
config/web.php
```

Procure por:

```php
'cookieValidationKey' => '',
```

E adicione um valor qualquer, exemplo:

```php
'cookieValidationKey' => 'minha_chave_secreta_123',
```

---

### 6. Testar no navegador

Agora abra:

```
http://localhost/meu_projeto/web/
```

Se tudo estiver certo, você verá a página inicial padrão do Yii2 🚀.

---

## 🔧 Dicas extras

* Se quiser evitar o `/web/` na URL, pode configurar um **virtual host** apontando direto para a pasta `/web`.
* O Yii2 básico já vem pronto para CRUDs e testes rápidos.
* Se futuramente você quiser usar o **Composer**, basta rodar dentro do projeto:

  ```
  composer install
  ```

---

👉 Quer que eu te mostre também como configurar o **hosts + sites.conf no Laragon** para acessar direto como `http://meuprojeto.test` em vez de `http://localhost/meu_projeto/web`?
