<table>
  <tr>
    <td><label for="ativo">Ativo ?</label></td>
    <td>{$ativo}</td>
  </tr>
  <tr>
    <td><label for="loginUser">{$labelLogin}:</label></td>
    <td>{$loginUser}</td>
  </tr>
  <tr>
    <td><label for="nomeCompleto">{$descricao}:</label></td>
    <td>{$nomeCompleto}</td>
  </tr>
  {if $grupo}
  <tr>
    <td><label for="senha">Senha:</label></td>
    <td>{$senha}</td>
  </tr>
  <tr>
    <td><label for="grupo">Grupo de acesso:</label></td>
    <td>{$grupo}</td>
  </tr>
  <tr>
    <td><label for="email">E-mail:</label></td>
    <td>{$email}</td>
  </tr>
  <tr>
    <td><label for="senhaEmail">Senha do e-mail:</label></td>
    <td>{$senhaEmail}</td>
  </tr>
  <tr>
    <td><label for="smtp">Servidor SMTP:</label></td>
    <td>{$smtp}</td>
  </tr>
  <tr>
    <td><label for="porta">Porta:</label></td>
    <td>{$porta}</td>
  </tr>
  {/if}
  <tr>
    <td><label for="id_empresa">Empresa:</label></td>
    <td>{$id_empresa}</td>
  </tr>
</table>